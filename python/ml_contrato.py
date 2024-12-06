from flask import Flask, request, jsonify
import numpy as np
import joblib
from sklearn.preprocessing import LabelEncoder
from flask_cors import CORS


app = Flask(__name__)
CORS(app)  

# Carregar o modelo treinado
# Carregar os modelos treinados e o encoder
modelo = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multinomial.joblib')
modelo2 = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multinomial2.joblib')
encoder = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder.joblib')

@app.route('/prever_disciplinas', methods=['GET'])
def prever_disciplinas():
    try:
        # Obter o ID do docente a partir dos parâmetros de consulta na URL
        id_docente = int(request.args.get('id_docente'))

        # Criar um array numpy com o ID do docente (reshape para uma única amostra)
        novo_docente_ids = np.array([[id_docente]])

        # Fazer previsões usando o modelo carregado (obter probabilidades)
        probabilidades = modelo.predict_proba(novo_docente_ids)

        # Obter todas as classes (ou disciplinas) disponíveis no modelo
        classes = modelo.classes_

        # Número máximo de disciplinas a serem previstas por docente
        num_disciplinas_previstas = 3  # Altere conforme necessário

        # Selecionar as disciplinas com as maiores probabilidades
        top_indices = np.argsort(probabilidades, axis=1)[:, -num_disciplinas_previstas:]  # Índices das disciplinas mais prováveis

        # Obter as disciplinas previstas e suas probabilidades
        disciplinas_previstas = [classes[idx] for idx in top_indices.ravel()]
        probabilidades_previstas = [probabilidades[0][idx] for idx in top_indices.ravel()]

        # Montar a resposta JSON com disciplinas e probabilidades
        resposta = [{'disciplina': disciplina, 'probabilidade': probabilidade}
                    for disciplina, probabilidade in zip(disciplinas_previstas, probabilidades_previstas)]

        # Retornar a resposta como JSON
        return jsonify({'id_docente': id_docente, 'disciplinas_previstas': resposta})
    
    except Exception as e:
        # Em caso de erro, retornar um JSON com o erro
        return jsonify({'error': str(e)}), 500


# Carregar os modelos treinados e o encoder
#modelo_path = 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multinomial2.joblib'
#encoder_path = 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder.joblib'



@app.route('/prever_professores', methods=['GET'])
def prever_professores():
    try:
        #modelo = joblib.load(modelo_path)
        #encoder = joblib.load(encoder_path)
        # Obter o código da disciplina a partir dos parâmetros de consulta na URL
        codigo_disciplina = request.args.get('codigo_disciplina')

        # Preparar o novo dado para previsão
        novo_dado_encoded = encoder.transform([[codigo_disciplina]])

        # Fazer a previsão das probabilidades dos professores para o novo dado
        probabilidades = modelo2.predict_proba(novo_dado_encoded)

        # Identificar os 3 professores mais prováveis
        top_indices = np.argsort(probabilidades, axis=1)[:, ::-1][:, :3]  # Inverter e pegar os top 3
        top_professores_ids = modelo2.classes_[top_indices].tolist()
        top_probabilidades = probabilidades[0, top_indices[0]].tolist()

        # Montar a resposta JSON com professores e probabilidades
        resposta = [{'professor_id': professor_id, 'probabilidade': probabilidade}
                    for professor_id, probabilidade in zip(top_professores_ids[0], top_probabilidades)]

        # Retornar a resposta como JSON
        return jsonify({'codigo_disciplina': codigo_disciplina, 'top_professores': resposta})

    except Exception as e:
        # Em caso de erro, retornar um JSON com o erro
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
    