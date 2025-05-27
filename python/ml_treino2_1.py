import sys
import json
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.preprocessing import OneHotEncoder
import joblib
from sklearn.metrics import precision_score, accuracy_score, recall_score

# Receber o caminho do arquivo temporário como argumento
temp_file_path = sys.argv[1]

try:
    # Ler os dados do arquivo temporário
    with open(temp_file_path, 'r') as file:
        dadosJson = file.read()

    # Converter os dados JSON para um dicionário Python
    dados = json.loads(dadosJson)
    
    # Criar arrays para armazenar IDs de professores (X) e códigos de disciplinas (y)
    professor_ids = []
    area_codigos = []
    disciplina_codigos = []

    # Extrair IDs de professores e códigos de disciplinas do dicionário
    for item in dados:
        professor_ids.append(int(item['id_docente_in_leciona']))
        area_codigos.append(item['cod_area_in_leciona'] or 'desconhecido')
        disciplina_codigos.append(item['codigo_disciplina_in_leciona'] or 'desconhecido')

    # Converter para arrays numpy
    X = np.array(list(zip(professor_ids, area_codigos)))  # ID do professor e área como recursos
    y = np.array(disciplina_codigos)  # Códigos das disciplinas como rótulos de saída
    
    # Codificar X
    encoder = OneHotEncoder(handle_unknown='ignore')
    X_encoded = encoder.fit_transform(X).toarray()  # Converte a matriz esparsa para densa

    # Dividir os dados em conjuntos de treino e teste
    X_train, X_test, y_train, y_test = train_test_split(X_encoded, y, test_size=0.2, random_state=42)

    # Escolher o modelo de Regressão Logística
    model = LogisticRegression(multi_class='ovr', max_iter=1000)

    # Treinar o modelo com os dados de treino
    model.fit(X_train, y_train)

    # Fazer previsões no conjunto de teste
    y_pred = model.predict(X_test)

    # Avaliar o desempenho do modelo com os dados de teste
    accuracy = accuracy_score(y_test, y_pred)
    precision = precision_score(y_test, y_pred, average='weighted')  # Use o average='weighted' para lidar com múltiplas classes
    f_score = model.score(X_test, y_test) 
    recall = recall_score(y_test, y_pred, average='weighted')  # Adicionando a métrica de sensibilidade (recall)
    print(f"Acurácia do modelo: {accuracy:.2f}")
    print(f"Precisão do modelo: {precision:.2f}")
    print(f"Score: {f_score:.2f}")
    print(f"sensibilidade (recall): {recall:.2}")
    # Salvar o modelo treinado e o encoder
    joblib.dump(model, 'C:\\wamp64\\www\\cead_pro\\python\\modelo_rl.joblib')
    joblib.dump(encoder, 'C:\\wamp64\\www\\cead_pro\\ython\\encoder_rl.joblib')
    print("Modelo treinado e salvo com sucesso!")

except FileNotFoundError:
    print(f"Arquivo não encontrado: {temp_file_path}")

except json.JSONDecodeError:
    print("Erro ao decodificar o arquivo JSON.")

except Exception as e:
    print(f"Erro ao processar os dados: {e}")
