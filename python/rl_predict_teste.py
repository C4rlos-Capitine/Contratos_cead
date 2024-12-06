from flask import Flask, request, jsonify
import numpy as np
import joblib
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Habilita o CORS para todo o aplicativo

# Carregar o modelo treinado e o encoder
modelo_disciplina = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_rl.joblib')
encoder_disciplina = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder_rl.joblib')

@app.route('/prever_disciplinas', methods=['GET'])
def prever_combinacoes():
    try:
        # Obter o ID do docente a partir do JSON da requisição
        id_docente = int(request.json['id_docente'])

        # Obter a lista de áreas de atuação
        areas = request.json['areas']

        n_areas = request.json['n_areas']
        n_prevestias = 0
        if(n_areas == 1): 
            n_prevestias = 7
        elif (n_areas == 2):
            n_prevestias = 6 
        elif (n_areas == 3):
            n_prevestias = 4
        else:
            n_prevestias = 3
        
        # Criar uma lista para armazenar as previsões
        previsoes = []

        for area in areas:
            cod_area_in_leciona = area['cod_area_in_leciona']
            
            # Criar um array numpy com o ID do docente e o código da área (reshape para uma única amostra)
            novo_dado = np.array([[id_docente, cod_area_in_leciona]])

            # Codificar o novo dado usando o encoder treinado
            novo_dado_encoded = encoder_disciplina.transform(novo_dado)

            # Fazer a previsão das probabilidades das disciplinas para o novo dado
            probabilidades = modelo_disciplina.predict_proba(novo_dado_encoded)

            # Obter todas as classes (disciplinas) disponíveis no modelo
            classes = modelo_disciplina.classes_

            # Número máximo de disciplinas a serem previstas por docente
            num_disciplinas_previstas = n_prevestias # Altere conforme necessário

            # Selecionar as disciplinas com as maiores probabilidades
            top_indices = np.argsort(probabilidades, axis=1)[:, -num_disciplinas_previstas:]  # Índices das disciplinas mais prováveis

            # Obter as disciplinas previstas e suas probabilidades
            disciplinas_previstas = [classes[idx] for idx in top_indices.ravel()]
            probabilidades_previstas = [probabilidades[0][idx] for idx in top_indices.ravel()]

            # Ordenar as disciplinas previstas e suas probabilidades em ordem decrescente de probabilidade
            previsoes_ordenadas = sorted(
                zip(disciplinas_previstas, probabilidades_previstas),
                key=lambda x: x[1],
                reverse=True
            )

            # Montar a resposta para esta área
            resposta = {
                'cod_area_in_leciona': cod_area_in_leciona,
                'disciplinas_previstas': [
                    {'codigo_disciplina': disciplina, 'probabilidade': probabilidade}
                    for disciplina, probabilidade in previsoes_ordenadas
                ]
            }
            previsoes.append(resposta)

        # Retornar a resposta como JSON, convertendo id_docente para int nativo do Python
        return jsonify({'id_docente': int(id_docente), 'n_areas':n_areas, 'previsoes': previsoes})
    
    except Exception as e:
        # Em caso de erro, retornar um JSON com o erro
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
