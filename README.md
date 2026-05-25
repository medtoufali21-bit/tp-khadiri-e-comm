# Symfony E-commerce Dockerizer

Projet Symfony 7.3 construit a partir de la base Docker fournie et des TPs EHEI 2025/2026.

## Fonctionnalites

- Docker avec Nginx, PHP, MySQL et phpMyAdmin.
- Catalogue de cours avec page d'accueil, liste, detail et cours similaires.
- Architecture service, handler, factory et interface comme dans les TPs.
- Formulaires Symfony : wishlist, newsletter, upload de cours, inscription et paiement simule.
- Doctrine : entites `Course` et `User`, migrations, persistance et lecture.
- Securite : inscription, connexion, deconnexion, hash du mot de passe.
- Panier simple base sur la session.

## Demarrage

```bash
make start
make install-packages
make create-database
docker compose exec php php bin/console doctrine:migrations:migrate
```

Application : http://localhost

phpMyAdmin : http://localhost:9002

## Pages utiles

- `/` : accueil
- `/catalog/all` : catalogue
- `/cart` : panier
- `/checkout` : paiement simule
- `/register` : inscription
- `/login` : connexion
- `/course` : upload d'un support de cours
- `/courses/all` : bibliotheque des cours uploades
