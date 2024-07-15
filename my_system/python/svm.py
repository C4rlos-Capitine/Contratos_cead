import json
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.svm import SVC
from sklearn.metrics import accuracy_score, hamming_loss, classification_report, precision_score, f1_score
import joblib
import sys
# Caminho do arquivo JSON com os dados
json_file_path = sys.argv[1]

try:
    # Ler os dados do arquivo JSON
    with open(json_file_path, 'r') as file:
        dadosJson = file.read()

    # Converter os dados JSON para um dicionário Python
    dados = json.loads(dadosJson)

    # Criar listas para armazenar IDs de professores e listas de disciplinas
    X = []
    y = []

    for item in dados:
        X.append(int(item['id_docente_in_leciona']))
        y.append(item['codigo_disciplina_in_leciona'])

    X = np.array(X).reshape(-1, 1)
    y = np.array(y)

    # Dividir os dados em conjuntos de treino e teste
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Inicializar e treinar o modelo SVM
    svm_model = SVC(kernel='linear', probability=True, random_state=42)
    svm_model.fit(X_train, y_train)

    # Previsões do modelo SVM
    y_pred = svm_model.predict(X_test)

    # Calcular e imprimir métricas de avaliação
    accuracy = accuracy_score(y_test, y_pred)
    hamming = hamming_loss(y_test, y_pred)
    precision = precision_score(y_test, y_pred, average='weighted')
    f1 = f1_score(y_test, y_pred, average='weighted')
    report = classification_report(y_test, y_pred)

    print(f"Acurácia: {accuracy:.2f}")
    print(f"Hamming Loss: {hamming:.2f}")
    print(f"Precision: {precision:.2f}")
    print(f"F1-Score: {f1:.2f}")
    print("Relatório de Classificação:")
    print(report)

    # Salvar o modelo treinado em um arquivo joblib
    joblib.dump(svm_model, 'modelo_svm.joblib')
    print("Modelo SVM treinado e salvo com sucesso!")

except FileNotFoundError:
    print(f"Arquivo não encontrado: {json_file_path}")

except json.JSONDecodeError:
    print("Erro ao decodificar o arquivo JSON.")

except Exception as e:
    print(f"Erro ao processar os dados: {e}")
