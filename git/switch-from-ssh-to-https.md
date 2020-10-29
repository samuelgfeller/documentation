# Switching remote URLs from SSH to HTTPS

1. Open Git Bash.
1. Change the current working directory to your local project.
1. List your existing remotes in order to get the name of the remote you want to change.
```bash
git remote -v
origin  git@hostname:USERNAME/REPOSITORY.git (fetch)
origin  git@hostname:USERNAME/REPOSITORY.git (push)
```
4. Change your remote's URL from SSH to HTTPS with the `git remote set-url` command.
```bash
git remote set-url origin https://hostname/USERNAME/REPOSITORY.git
```
5. Verify that the remote URL has changed.
```bash
git remote -v
# Verify new remote URL
origin  https://hostname/USERNAME/REPOSITORY.git (fetch)
origin  https://hostname/USERNAME/REPOSITORY.git (push)
```

This can be done if following error message appears:
```
Update failed
git@github.com: Permission denied (publickey).
Could not read from remote repository.
			
Please make sure you have the correct access rights
and the repository exists.
```


--- 
Source: https://help.github.jp/enterprise/2.11/user/articles/changing-a-remote-s-url/#switching-remote-urls-from-ssh-to-https
