# GIT cheatsheet

### Undo most recent comit
```bash
git reset HEAD~
```
Source: https://stackoverflow.com/a/927386/9013718

### Using github in CLI with access token and HTTPS
All the functions work when adding `<GITHUB_ACCESS_TOKEN>@` before the repo link.  
Examples:   
```
git clone --bare https://<GITHUB_ACCESS_TOKEN>@github.com/samuelgfeller/repository-name.git

git push https://<GITHUB_ACCESS_TOKEN>@github.com/samuelgfeller/repository-name.git
```

### Overwrite local changes with origin
1. Check out local master/develop
2. Make Git pull (or update project)
3. Open Git Console
4. git reset --hard
