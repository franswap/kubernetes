# GESTION PRODUITS

## Déploiement avec Docker 

1. **Lancer la stack complète**
`docker-compose up --build`

## Déploiement avec Kubernetes k3d

1. **Création du cluster**
```bash
k3d cluster create tp-k8s \
  --port "443:443@loadbalancer" \
  --agents 2
```

2. **Création du namespace**
`kubectl apply -f k8s/`

1. **Création des ressources**
`kubectl apply -f k8s/ --recursive`

1. **Ajouter dans le fichier hosts cette ligne pour rediriger les domaines vers localhost**
```
127.0.0.1     domaine.fr www.domaine.fr dev.domaine.fr
```

1. **Connexion à l'application :**
    - Login : `admin`
    - Mot de passe : `password`
    - URL Production (MySQL) : https://www.domaine.fr
    - URL Développement (PostgreSQL) : https://dev.domaine.fr