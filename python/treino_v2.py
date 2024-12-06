import sys
import json
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import OneHotEncoder
from sklearn.linear_model import LogisticRegression
import joblib

# Receber o caminho do arquivo temporário como argumento
temp_file_path = "C:\\wamp64\\www\\cead_template2\\my_system\\python\\data_testes.json"

try:
    # Ler os dados do arquivo temporário
    with open(temp_file_path, 'r') as file:
        dadosJson = file.read()

    # Converter os dados JSON para um dicionário Python
    dados = json.loads(dadosJson)

    # Extrair os campos necessários dos dados
    docente_ids = []
    curso_ids = []
    disciplina_codigos = []
    centro_recursos = []

    for item in dados:
        docente_ids.append(item['id_docente'])
        curso_ids.append(item['id_curso'])
        disciplina_codigos.append(item['codigo_disciplina'])
        centro_recursos.append(item['id_centro_de_recurso'])

    # Preparar a entrada X como a combinação de id_curso, codigo_disciplina e centro_de_recursos
    X = np.array(list(zip(curso_ids, disciplina_codigos, centro_recursos)))

    # Codificar as combinações usando OneHotEncoder
    encoder = OneHotEncoder(handle_unknown='ignore')
    X_encoded = encoder.fit_transform(X)

    # Os docentes serão os rótulos de saída
    y = np.array(docente_ids)

    # Dividir os dados em conjuntos de treino e teste
    X_train, X_test, y_train, y_test = train_test_split(X_encoded, y, test_size=0.2, random_state=42)

    # Escolher o modelo de regressão logística multinomial
    model = LogisticRegression(multi_class='multinomial', solver='lbfgs', max_iter=1000)

    # Treinar o modelo com os dados de treino
    model.fit(X_train, y_train)

    # Avaliar o desempenho do modelo com os dados de teste
    accuracy = model.score(X_test, y_test)
    print(f"Acurácia do modelo: {accuracy:.2f}")

    # Salvar o modelo treinado e o encoder
    joblib.dump(model, 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_docente.joblib')
    joblib.dump(encoder, 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder_docente.joblib')

except FileNotFoundError:
    print(f"Arquivo não encontrado: {temp_file_path}")

except json.JSONDecodeError:
    print("Erro ao decodificar o arquivo JSON.")

except Exception as e:
    print(f"Erro ao processar os dados: {e}")
