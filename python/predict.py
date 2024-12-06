import numpy as np
import joblib



# Carregar o modelo treinado
modelo = joblib.load('modelo_multinomial.joblib')

# ID do docente para o qual deseja fazer previsões
id_docente = 5  # Substitua pelo ID do docente desejado

# Criar um array numpy com o ID do docente (reshape para uma única amostra)
novo_docente_ids = np.array([[id_docente]])

# Fazer previsões usando o modelo carregado (obter probabilidades)
probabilidades = modelo.predict_proba(novo_docente_ids)
print("probabilidades")
print(probabilidades)
# Obter todas as classes (ou disciplinas) disponíveis no modelo
classes = modelo.classes_

# Número máximo de disciplinas a serem previstas por docente
num_disciplinas_previstas = 5  # Altere conforme necessário

# Selecionar as disciplinas com as maiores probabilidades
top_indices = np.argsort(probabilidades, axis=1)[:, -num_disciplinas_previstas:]  # Índices das disciplinas mais prováveis
print(top_indices)
print("\n--------------------------------\n")
# Obter as disciplinas previstas com base nos índices
disciplinas_previstas = [classes[idx] for idx in top_indices.ravel()]

print(f"Disciplinas previstas para o docente com ID {id_docente}: {disciplinas_previstas}")
