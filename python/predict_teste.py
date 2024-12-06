from flask import Flask, request, jsonify
import joblib
import numpy as np
import json

app = Flask(__name__)

@app.route('/prever_combinacoes', methods=['GET'])
def prever_combinacoes():
    # Receber o ID do docente a partir dos parâmetros de consulta na URL
    id_docente = int(request.args.get('id_docente'))
    
    # Caminhos dos arquivos do modelo e encoder
    modelo_path = 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_docente.joblib'
    encoder_path = 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder_docente.joblib'
    data_path = 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\data_testes.json'

    try:
        # Carregar o modelo treinado
        model = joblib.load(modelo_path)

        # Carregar o encoder
        encoder = joblib.load(encoder_path)

        # Carregar os dados de combinações do arquivo JSON
        with open(data_path, 'r') as file:
            dados_json = json.load(file)

        # Extrair os campos necessários dos dados
        curso_ids = []
        disciplina_codigos = []
        centro_recursos = []

        for item in dados_json:
            curso_ids.append(item['id_curso'])
            disciplina_codigos.append(item['codigo_disciplina'])
            centro_recursos.append(item['id_centro_de_recurso'])

        # Preparar a entrada X como a combinação de id_curso, codigo_disciplina e centro_de_recursos
        combinacoes_possiveis = np.array(list(zip(curso_ids, disciplina_codigos, centro_recursos)))

        # Codificar as combinações usando o encoder treinado
        combinacoes_encoded = encoder.transform(combinacoes_possiveis)

        # Fazer a previsão das probabilidades para cada combinação
        probabilidades = model.predict_proba(combinacoes_encoded)

        # Filtrar as previsões para o docente específico
        docente_indices = np.where(model.classes_ == id_docente)[0]
        docente_probabilidades = probabilidades[:, docente_indices].flatten()

        # Identificar as combinações mais prováveis para o docente
        top_comb_indices = np.argsort(docente_probabilidades)[::-1][:5]
        top_combinacoes = combinacoes_possiveis[top_comb_indices]

        # Montar a resposta JSON
        response = {
            'id_docente': id_docente,
            'top_combinacoes': top_combinacoes.tolist()
        }

        # Retornar a resposta como JSON
        return jsonify(response)

    except Exception as e:
        # Em caso de erro, retornar um JSON com o erro
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
