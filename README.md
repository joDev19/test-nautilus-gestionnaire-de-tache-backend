# test-nautilus-gestionnaire-de-tache-backend
## Installation du projet
### S'assurer d'avoir php - composer et mysql installer

1. Cloner le projet avec la commande :  
    ```bash
    git clone repository_url
    ```

2. Taper la commande :  
    ```bash
    composer install
    ```

3. Créer un fichier `.env`.

4. Copier le contenu du fichier `.env.example` à la racine et le coller dans le `.env`.

5. Taper la commande :  
    ```bash
    php artisan key:generate
    ```

6. Taper la commande :  
    ```bash
    php artisan migrate
    ```

7. Taper la commande :  
    ```bash
    php artisan serve
    ```

**Vous avez réussi !** 🎉
