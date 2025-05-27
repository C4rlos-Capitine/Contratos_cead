import sys
import json
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.preprocessing import OneHotEncoder
import joblib
from sklearn.metrics import accuracy_score, precision_score, recall_score

# Receber o caminho do arquivo temporário como argumento
temp_file_path = sys.argv[1]

try:
    # Ler os dados do arquivo temporário
    with open(temp_file_path, 'r') as file:
        dadosJson = file.read()

    # Converter os dados JSON para um dicionário Python
    dados = json.loads(dadosJson)

    # Criar arrays para armazenar códigos de áreas, códigos de disciplinas (X) e IDs de professores (y)
    area_codigos = []
    disciplina_codigos = []
    professor_ids = []

    # Extrair códigos de áreas, códigos de disciplinas e IDs de professores do dicionário
    for item in dados:
        area_codigos.append(item['cod_area_in_leciona'] or 'desconhecido')
        disciplina_codigos.append(item['codigo_disciplina_in_leciona'] or 'desconhecido')
        professor_ids.append(int(item['id_docente_in_leciona']))

    # Converter para arrays numpy e reshape para adequar ao formato necessário
    X = np.array(list(zip(area_codigos, disciplina_codigos)))  # Códigos das áreas e disciplinas como características
    y = np.array(professor_ids)  # IDs dos professores como rótulos de saída
    print("X:")
    print(X)
    print("Y: ")
    print(y)

    # Codificar as características usando OneHotEncoder
    encoder = OneHotEncoder(handle_unknown='ignore')
    X_encoded = encoder.fit_transform(X)

    # Dividir os dados em conjuntos de treino e teste
    X_train, X_test, y_train, y_test = train_test_split(X_encoded, y, test_size=0.2, random_state=42)

    # Escolher o modelo de regressão logística multinomial
    model = LogisticRegression(multi_class='multinomial', solver='lbfgs', max_iter=1000)

    # Treinar o modelo com os dados de treino
    model.fit(X_train, y_train)

    # Fazer previsões no conjunto de teste
    y_pred = model.predict(X_test)

    # Avaliar o desempenho do modelo com os dados de teste
    accuracy = accuracy_score(y_test, y_pred)
    precision = precision_score(y_test, y_pred, average='weighted')  # Use average='weighted' para múltiplas classes
    f_score = model.score(X_test, y_test) 
    recall = recall_score(y_test, y_pred, average='weighted')  # Adicionando a métrica de sensibilidade (recall)
    print(f"Acurácia do modelo: {accuracy:.2f}")
    print(f"Precisão do modelo: {precision:.2f}")
    print(f"Score: {f_score:.2f}")
    print(f"sensibilidade (recall): {recall:.2}")
    # Salvar o modelo treinado e o encoder
    joblib.dump(model, 'C:\\wamp64\\www\\cead_pro\\python\\modelo_docente_rl.joblib')
    joblib.dump(encoder, 'C:\\wamp64\\www\\cead_pro\\python\\encoder_docente_rl.joblib')
    print("Modelo treinado e salvo com sucesso!")

except FileNotFoundError:
    print(f"Arquivo não encontrado: {temp_file_path}")

except json.JSONDecodeError:
    print("Erro ao decodificar o arquivo JSON.")

except Exception as e:
    print(f"Erro ao processar os dados: {e}")
