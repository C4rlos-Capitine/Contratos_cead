import numpy as np
import joblib

# Função para prever disciplinas com base no id_docente_in_leciona
def prever_disciplinas(id_docente):
    # Carregar o modelo treinado
    model = joblib.load('C:\\wamp64\\www\\cead_template2\\my_system\\python\\modelo_random_forest.joblib')
    # Fazer a previsão
    id_docente_array = np.array([id_docente]).reshape(-1, 1)
    predicao = model.predict(id_docente_array)
    return predicao

# Exemplo de uso da função de previsão
id_docente_exemplo = 1  # Substitua pelo ID do professor desejado
disciplinas_previstas = prever_disciplinas(id_docente_exemplo)
print(f"Disciplinas previstas para o docente {id_docente_exemplo}: {disciplinas_previstas}")
