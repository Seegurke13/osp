@echo off

docker exec -it 41f2ee9ce8ed4c288fd8679fabff5dc22f73275de5fa7d535ba00d4f0de49684 /app/bin/console doctrine:schema:update --force