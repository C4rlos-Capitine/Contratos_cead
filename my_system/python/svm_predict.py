import numpy as np
import joblib

# Função para prever múltiplas disciplinas com base no id_docente_in_leciona
def prever_disciplinas(id_docente):
    # Carregar o modelo treinado
    model, unique_disciplinas = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_multilabel_random_forest.joblib')
    
    # Fazer a previsão das probabilidades
    id_docente_array = np.array([id_docente]).reshape(-1, 1)
    predicao = model.predict(id_docente_array)
    
    # Obter as disciplinas previstas
    disciplinas_previstas = [unique_disciplinas[i] for i in range(len(unique_disciplinas)) if predicao[0][i] == 1]
    
    return disciplinas_previstas

# Exemplo de uso da função de previsão
id_docente_exemplo = 5  # Substitua pelo ID do professor desejado
disciplinas_previstas = prever_disciplinas(id_docente_exemplo)
print(f"Disciplinas previstas para o docente {id_docente_exemplo}: {disciplinas_previstas}")
