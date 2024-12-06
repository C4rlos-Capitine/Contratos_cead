import numpy as np
import joblib

# Função para prever as 3 disciplinas mais prováveis com base no id_docente_in_leciona e cod_area_in_leciona
def prever_disciplinas(id_docente, cod_area):
    # Carregar o modelo treinado e o encoder
    model = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_svm.joblib')
    encoder = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\encoder_svm.joblib')
    
    # Criar o array de entrada para o id_docente e cod_area
    input_array = np.array([[id_docente, cod_area]])

    # Aplicar One-Hot Encoding na entrada
    input_encoded = encoder.transform(input_array)

    # Obter as probabilidades das previsões para cada disciplina
    probabilidades = model.predict_proba(input_encoded)

    # Obter os índices das três disciplinas mais prováveis
    top_3_indices = np.argsort(probabilidades[0])[-3:][::-1]
    
    # Obter os nomes das disciplinas correspondentes
    disciplinas_top_3 = model.classes_[top_3_indices]
    
    # Retornar as três disciplinas mais prováveis
    return disciplinas_top_3

# Exemplo de uso da função de previsão
id_docente_exemplo = 3  # Substitua pelo ID do professor desejado
cod_area_exemplo = "INF"  # Substitua pelo código da área desejado
disciplinas_previstas = prever_disciplinas(id_docente_exemplo, cod_area_exemplo)

print(f"As 3 disciplinas mais prováveis para o docente {id_docente_exemplo} na área {cod_area_exemplo} são: {disciplinas_previstas}")
