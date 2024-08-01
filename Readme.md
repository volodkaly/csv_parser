<h1>1. Nainstalujte docker a ověřte, že je nainstalován.</h1>
Postupujte dle návodu:
https://docs.docker.com/engine/install/

K ověření, že docker je nainstalován, zadejte v terminálu příkaz:
docker -v

V případě úspěchu se zobrazí odpověď: <br>
Docker version 24.0.7, build 24.0.7-0ubuntu2~22.04.1

a dále příkaz:
docker run hello-world

V případě úspěchu se zobrazí odpověď:

Hello from Docker!
This message shows that your installation appears to be working correctly.

To generate this message, Docker took the following steps:
 1. The Docker client contacted the Docker daemon.
 2. The Docker daemon pulled the "hello-world" image from the Docker Hub.
    (amd64)
 3. The Docker daemon created a new container from that image which runs the
    executable that produces the output you are currently reading.
 4. The Docker daemon streamed that output to the Docker client, which sent it
    to your terminal.

To try something more ambitious, you can run an Ubuntu container with:
 $ docker run -it ubuntu bash

Share images, automate workflows, and more with a free Docker ID:
 https://hub.docker.com/

For more examples and ideas, visit:
 https://docs.docker.com/get-started/



<h1>2. Naklonujte repozitář:</h1>

git clone https://github.com/volodkaly/csv_parser.git  <br>
cd [cesta_k_repositáři]

<h1>3. Vytvořte a spusťte Docker kontejner:</h1>

docker build -t oscar-winners-app . <br>
docker run -d -p 8000:8000 oscar-winners-app

<h1>Otevřete webový prohlížeč a přejděte na:</h1>

http://localhost:8000


<h1>4. Nahrajte soubory oscar_age_female.csv a oscar_age_male.csv a stiskněte tlačítko odeslat.</h1>

<em>Popis souborů <br>
index.html - HTML soubor obsahující formulář pro nahrávání souborů a zobrazení výsledků. <br>
upload.php - PHP skript pro zpracování nahraných CSV souborů a zobrazení výsledků. <br>
Dockerfile - Docker soubor pro nastavení PHP prostředí.
</em>

