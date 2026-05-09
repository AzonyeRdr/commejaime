# Workflow Git avec une branche `dev`

Si tu travailles principalement sur une branche `dev`, le workflow classique est :

- `main` → version stable
- `dev` → branche de développement principale
- branches secondaires → fonctionnalités, tests, corrections

---

# 1. Aller sur `dev`

```bash
git checkout dev
```

Mettre à jour :

```bash
git pull
```

---

# 2. Créer une branche à partir de `dev`

Exemple : créer une feature

```bash
git checkout -b feature-login
```

Cette branche contient exactement tout ce qu’il y a dans `dev`.

---

# 3. Travailler dans la branche

```bash
git add .
git commit -m "Ajout login"
```

---

# 4. Push la nouvelle branche

Premier push :

```bash
git push -u origin feature-login
```

Après :

```bash
git push
```

---

# 5. Fusionner la branche dans `dev`

Quand la feature est terminée :

## Revenir sur `dev`

```bash
git checkout dev
```

## Mettre à jour `dev`

```bash
git pull
```

## Merge

```bash
git merge feature-login
```

## Push

```bash
git push
```

---

# 6. Supprimer la branche feature

Locale :

```bash
git branch -d feature-login
```

Distante :

```bash
git push origin --delete feature-login
```

---

# Workflow complet recommandé

## Créer feature depuis dev

```bash
git checkout dev
git pull
git checkout -b feature-chat
```

## Travail

```bash
git add .
git commit -m "Ajout chat"
```

## Push

```bash
git push -u origin feature-chat
```

## Merge vers dev

```bash
git checkout dev
git pull
git merge feature-chat
git push
```

---

# Important : toujours créer les branches depuis `dev`

Sinon tu risques de créer une branche depuis `main` avec du code ancien.

Toujours faire :

```bash
git checkout dev
git pull
git checkout -b nouvelle-branche
```

---

# Exemple d’organisation

```text
main
 └── dev
      ├── feature-login
      ├── feature-chat
      ├── fix-ui
      └── test-ai
```

Puis :

- `feature-*` → fusion vers `dev`
- `dev` → fusion vers `main` quand stable

---

# Pour récupérer les nouvelles modifications de dev dans une feature

Depuis ta feature :

```bash
git checkout feature-login
git merge dev
```

ou :

```bash
git stash
git rebase dev
git stash pop
```

---

# Si tu veux remplacer complètement une branche par `dev`

Exemple :

```bash
git checkout test
git reset --hard dev
git push --force
```

`test` devient une copie exacte de `dev`.

