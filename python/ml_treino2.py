import sys
import json
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import OneHotEncoder
from sklearn.linear_model import LogisticRegression
import joblib

# Receber o caminho do arquivo temporário como argumento
temp_file_path = sys.argv[1]

try:
    # Ler os dados do arquivo temporário
    with open(temp_file_path, 'r') as file:
        dadosJson = file.read()

    # Converter os dados JSON para um dicionário Python
    dados = json.loads(dadosJson)

    # Criar arrays para armazenar IDs de professores (y) e códigos de disciplinas (X)
    professor_ids = []
    disciplina_codigos = []

    # Extrair IDs de professores e códigos de disciplinas do dicionário
    for item in dados:
        professor_ids.append(int(item['id_docente_in_leciona']))
        disciplina_codigos.append(item['codigo_disciplina_in_leciona'])

    # Converter para arrays numpy
    X = np.array(disciplina_codigos).reshape(-1, 1)  # Código da disciplina como recurso único
    y = np.array(professor_ids)  # IDs dos professores como rótulos de saída

    # Codificar os códigos das disciplinas usando OneHotEncoder
    encoder = OneHotEncoder(handle_unknown='ignore')
    X_encoded = encoder.fit_transform(X)

    # Salvar o encoder treinado em um arquivo joblib
    joblib.dump(encoder, 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder.joblib')
    print("Encoder salvo com sucesso!")

    # Dividir os dados em conjuntos de treino e teste
    X_train, X_test, y_train, y_test = train_test_split(X_encoded, y, test_size=0.2, random_state=42)

    # Escolher o modelo de regressão logística multinomial
    model = LogisticRegression(multi_class='multinomial', solver='lbfgs', max_iter=1000)

    # Treinar o modelo com os dados de treino
    model.fit(X_train, y_train)

    # Avaliar o desempenho do modelo com os dados de teste
    accuracy = model.score(X_test, y_test)
    print(f"Acurácia do modelo: {accuracy:.2f}")

    # Salvar o modelo treinado em um arquivo joblib
    joblib.dump(model, 'C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multinomial2.joblib')
    print("Modelo treinado e salvo com sucesso!")

except FileNotFoundError:
    print(f"Arquivo não encontrado: {temp_file_path}")

except json.JSONDecodeError:
    print("Erro ao decodificar o arquivo JSON.")

except Exception as e:
    print(f"Erro ao processar os dados: {e}")
