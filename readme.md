# Jogador Caro
#### O futeba nunca mais será o mesmo.

Classifique os Jogadores por níveis de Habilidades, monte times equilibrados, evite as panelinhas, aumente a competitividade das partidas = Jogos Inesquecíveis.

# O Desenvolvimento do Jogador Caro

Com docker compose, criei uma rede e volumes com containers Debian (também gosto do Alpine) para a comunicação e acesso a cada container para separar melhor
a estrutura em microsserviços quando em produção.

Para instalar a estrutura em ambiente local, certifique-se que seu computador tenha instalado o cliente docker e docker compose.
Visite a [documentação oficial do docker](https://docs.docker.com/engine/install/) e siga as instruções para o seu sistema operacional.

Certifique-se de que você tenha instalado o cliente do Git em sua máquina. Mais informações [aqui](https://github.com/git-guides/install-git)

Clone este projeto no seu ambiente local em uma pasta vazia utilizando o comando

        git clone https://github.com/adrianoalves/jogador-caro.git .

Dentro da pasta do projeto, execute

        docker-compose up -d
ou

        docker-compose up --build

Ao finalizar a instalação dos containers, para saber se tudo foi instalado corretamente e está funcionando, execute

        docker ps --format="table {{.ID}}\\t{{.Image}}\\t{{.Status}}\\t{{.Names}}\\t{{.Ports}}"

você verá uma lista de containers, com status, nome, id, nome da imagem e portas.

Utilize o nome do container sob a coluna *NAMES* para acessar os containers e continuar a instalação.

Para acessar um container, basta usar a parte do nome que vem depois do namespace "jc_" num comando __exec__:

        docker-compose exec app bash

No comando acima, você acessará o container do backend via terminal tty. 
Para continuar a instalação do backend, uma vez acessado o container, copie o *.env.example* e renomeie para *.env* e execute

        composer install

Certifique-se de que tudo está funcionando com um

        php artisan

Para concluir a instalação do backend, execute

        php artisan migrate
        php artisan db:seed

Para o frontend acesse o container através do comando

        docker-compose exec frontend bash

Execute

        npm install --global yarn
        yarn install
        quasar dev

Para o build execute
        
        quasar build -m pwa

## Backend

- Laravel
- MariaDB
- Docker Compose
- Redis
- Crontab
- Nginx com PHP-FPM
- PHP 8.2

## Frontend

- Vuejs 3
- Pinia
- Quasar
- Vite

### Considerações Finais

Neste desafio, trouxe algumas habilidades básicas de Full Stack para o desenvolvimento de uma aplicação híbrida PWA em Vue/Quasar
com api em Laravel.