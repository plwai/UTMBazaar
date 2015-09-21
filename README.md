# UTMBazaar

###Cooperative tools

1. Slack
2. Github
3. Kanbanflow
4. Trello (Another scrum scheduler just for information purpose. I will update it by my own)

###Contribute

- For SSH, clone the repo ```git@github.com:plwai/UTMBazaar.git``` into your directory
- For HTTPS, clone the repo ```https://github.com/plwai/UTMBazaar.git``` into your directory
- ```git checkout -branch *your_branch_name*```
- Commit your work to your own branch ```git push origin *your_branch_name*```
- Make sure to check if there are any changes from remote master, and rebase your branch with the latest master
  - ```git fetch```
  - If there are some uncommitted changes, stash your work before rebase ```git stash```
  - ```git pull --rebase origin master```
  - Fix merge conflicts (if any?)
  - After rebase then ```git stash pop``` to bring back all uncommitted changes
- Submit a pull request, and write descriptive comments.
