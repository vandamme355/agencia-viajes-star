import pickle

# Ejercicio 2: Almacenar y Recuperar Configuraciones de la Aplicación

# Función para guardar configuraciones en un archivo
def guardar_configuraciones(configuraciones, archivo):
    """Guarda las configuraciones en un archivo binario usando Pickle."""
    with open(archivo, 'wb') as f:
        pickle.dump(configuraciones, f)

# Función para recuperar configuraciones desde un archivo
def recuperar_configuraciones(archivo):
    """
    Recupera las configuraciones desde un archivo binario.
        Si el archivo no existe, retorna un diccionario vacío.
    """
    try:
        with open(archivo, 'rb') as f:
            configuraciones = pickle.load(f)
        return configuraciones
    except FileNotFoundError:
        return {}

# Definir configuraciones iniciales
configuraciones_iniciales = {
    "idioma": "español",
    "tema": "oscuro",
    "notificaciones": True
}

# Definir el nombre del archivo donde se almacenarán las configuraciones
archivo_configuraciones = "configuraciones.pkl"

# Guardar las configuraciones en el archivo
guardar_configuraciones(configuraciones_iniciales, archivo_configuraciones)

# Recuperar las configuraciones desde el archivo
configuraciones_recuperadas = recuperar_configuraciones(archivo_configuraciones)

# Mostrar resultados
print("Configuraciones Recuperadas:", configuraciones_recuperadas)
