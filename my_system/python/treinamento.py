'''
import sys
import json
import numpy as np
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import LabelEncoder
import joblib

# Receber o caminho do arquivo temporário como argumento
temp_file_path = sys.argv[1]
#print(temp_file_path)

try:
    # Ler os dados do arquivo temporário
    with open(temp_file_path, 'r') as file:
        dadosJson = file.read()

    # Converter os dados JSON para um dicionário Python
    dados = json.loads(dadosJson)
    print(dados)
    # Extrair X (IDs dos docentes) e y (códigos das disciplinas)
    X = np.array([item['id_docente_in_leciona'] for item in dados]).reshape(-1, 1)
    y = np.array([item['codigo_disciplina_in_leciona'] for item in dados])

    # Transformar y (códigos das disciplinas) em formato numérico
    label_encoder = LabelEncoder()
    y_encoded = label_encoder.fit_transform(y)

    # Criar e treinar o modelo RandomForestClassifier
    model = RandomForestClassifier()
    model.fit(X, y_encoded)

    try:
        joblib.dump(model, 'C:\wamp64\www\cead_template2\my_system\python\modelo_ml6.joblib')
        print("Modelo treinado salvo com sucesso.")
    except Exception as save_error:
        print(f"Erro ao salvar o modelo treinado: {save_error}")

except Exception as e:
    print(f"Erro ao processar os dados: {e}")
'''
import sys
import json
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
import joblib

# Receber o caminho do arquivo temporário como argumento
temp_file_path = sys.argv[1]
print(temp_file_path)
try:
    # Ler os dados do arquivo temporário
    with open(temp_file_path, 'r') as file:
        dadosJson = file.read()

    # Converter os dados JSON para um dicionário Python
    dados = json.loads(dadosJson)

    # Criar arrays para armazenar IDs de professores (X) e códigos de disciplinas (y)
    professor_ids = []
    disciplina_codigos = []

    # Extrair IDs de professores e códigos de disciplinas do dicionário
    for item in dados:
        professor_ids.append(int(item['id_docente_in_leciona']))
        disciplina_codigos.append(item['codigo_disciplina_in_leciona'])

    print(professor_ids)
    print("\n")
    print(disciplina_codigos)
    # Converter para arrays numpy e reshape para adequar ao formato necessário
    X = np.array(professor_ids).reshape(-1, 1)  # ID do professor como recurso único
    y = np.array(disciplina_codigos)  # Códigos das disciplinas como rótulos de saída
    print("\n")
    print(X)
    print(y)
    # Criar e treinar o modelo de regressão logística
    #model = LogisticRegression()
    try:
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

        # Escolha do modelo e treinamento
        model = LogisticRegression()
        model.fit(X_train, y_train)

        # Salvar o modelo treinado em um arquivo joblib
        joblib.dump(model, 'C:\wamp64\www\cead_template2\my_system\python\modelo_ml7.joblib')
        print("Modelo treinado e salvo com sucesso!")

    except ValueError as value_error:
        print(f"Erro ao ajustar o modelo: {value_error}")

    except TypeError as type_error:
        print(f"Erro de tipo durante o ajuste do modelo: {type_error}")

    except MemoryError as memory_error:
        print(f"Erro de memória durante o ajuste do modelo: {memory_error}")

except Exception as e:
    print(f"Erro ao processar os dados: {e}")