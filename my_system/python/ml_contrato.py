from flask import Flask, request, jsonify
import numpy as np
import joblib
from sklearn.preprocessing import LabelEncoder
from flask_cors import CORS
app = Flask(__name__)

# Carregar o modelo treinado
modelo = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multinomial.joblib')
modelo2 = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multinomial2.joblib')
encoder = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder.joblib')

app = Flask(__name__)
CORS(app)  # Habilita o CORS para todo o aplicativo


@app.route('/prever_disciplinas', methods=['GET'])
def prever_disciplinas():
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

    # Obter as disciplinas previstas com base nos índices
    disciplinas_previstas = [classes[idx] for idx in top_indices.ravel()]

    # Retornar as disciplinas previstas como resposta JSON
    return jsonify({'disciplinas_previstas': disciplinas_previstas})

from flask import Flask, request, jsonify
import joblib
import numpy as np



@app.route('/prever_professores', methods=['GET'])
def prever_professores():
    # Obter o código da disciplina a partir dos parâmetros de consulta na URL
    codigo_disciplina = request.args.get('codigo_disciplina')
    
    # Caminhos dos arquivos do modelo e encoder
    modelo_path = 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multinomial2.joblib'
    encoder_path = 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder.joblib'

    try:
        # Carregar o modelo treinado
        model = joblib.load(modelo_path)

        # Carregar o encoder
        encoder = joblib.load(encoder_path)

        # Preparar o novo dado para previsão
        novo_dado = {'codigo_disciplina': codigo_disciplina}
        novo_dado_encoded = encoder.transform([[novo_dado['codigo_disciplina']]])

        # Fazer a previsão das probabilidades dos professores para o novo dado
        probabilidades = model.predict_proba(novo_dado_encoded)

        # Identificar os 5 professores mais prováveis
        top_professores_indices = np.argsort(probabilidades, axis=1)[:, ::-1][:, :3]  # Inverter e pegar os top 5
        top_professores_ids = model.classes_[top_professores_indices].tolist()

        # Montar a resposta JSON
        response = {
            'codigo_disciplina': codigo_disciplina,
            'top_professores_ids': top_professores_ids
        }

        # Retornar a resposta como JSON
        return jsonify(response)

    except Exception as e:
        # Em caso de erro, retornar um JSON com o erro
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
    