# Eventy.tn - README

Bienvenue sur **Eventy.tn**, une plateforme web qui offre aux utilisateurs la possibilité de découvrir les meilleurs bons plans (Restaurants, Boutiques, etc.) tout en facilitant la visualisation des événements et l'achat de billets en ligne. La plateforme est divisée en trois parties principales, chacune dédiée à un type d'utilisateur : Restaurateurs, Organisateurs, et Participants.

## Structure du Projet

Le projet **Eventy.tn** est organisé en trois sections principales :

### 1. Partie Web dédiée aux Restaurations
Cette partie permet aux restaurateurs de :
- S'authentifier et gérer leur profil.
- Publier des offres, des événements ou des promotions.
- Consulter les événements organisés sur la plateforme.

### 2. Partie Web dédiée aux Organisateurs
Cette partie permet aux organisateurs d'événements de :
- S'authentifier et gérer leur profil.
- Créer, modifier et gérer des événements.
- Consulter les publications sur les événements d'autres organisateurs ou des restaurateurs.

### 3. Partie Web dédiée aux Participants
Cette partie permet aux participants de :
- S'authentifier et gérer leur profil.
- Acheter des billets pour les événements avec un système de paiement en ligne.
- Consulter les événements et les publications.
- Ajouter des commentaires et des avis sur les événements et les publications.

## Technologies Utilisées

Le développement du projet **Eventy.tn** est basé sur une architecture moderne et utilise les technologies suivantes :

### Backend
- **Laravel** : Le framework PHP Laravel est utilisé pour le développement des services web côté serveur. Il gère les opérations de l'API RESTful, l'authentification, la gestion des utilisateurs, la gestion des événements, et l'achat de billets.
- **MySQL** : La base de données relationnelle MySQL est utilisée pour stocker les informations relatives aux utilisateurs, aux événements, aux publications, et aux transactions.

### Frontend
- **VueJS** : Framework JavaScript utilisé pour le développement de l'interface utilisateur et pour consommer les API fournies par le backend Laravel.
- **Axios** : Librairie utilisée pour effectuer des appels HTTP vers l'API backend depuis le frontend.

### Autres outils et techniques
- **Cloudinary** : Utilisé pour la gestion des images sur la plateforme. Cloudinary permet de télécharger, stocker, transformer, et livrer des images optimisées via un CDN. Toutes les images des événements, publications et profils utilisateurs sont gérées via ce service.
- **JWT (JSON Web Tokens)** : Utilisé pour gérer l'authentification sécurisée des utilisateurs sur toute la plateforme.
- **Stripe** : Intégration des services de paiement pour l'achat des billets en ligne.

## Démo

Pour voir une démo vidéo de l'application en action, cliquez sur le lien ci-dessous :

https://drive.google.com/file/d/1-HWWiplhTEiaj4rq9h2nGuSxc7lnnS-3/view?usp=sharing
