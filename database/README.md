<div style="text-align: center;"><h1 style="color:blue"> DATABASE </h1><hr> 

#### Creating Postgres DB with Docker Compose

#### POSTGRES Version: 15.2

<hr>

# Diagramm

 -![alt text](diagram/diagram.png) 


<hr>
</div>

### RUN 
- make sure you are in the database folder

```bash
sudo docker-compose up
```

### Clear RUN
```bash
sudo docker-compose down
```

```bash
sudo docker system prune -a
```
```bash
sudo rm -r postgres-data/
```
<hr>

### Connect to database Local

-  HOST : 172.30.0.2
-  PORT : 5432
-  DATABASE: orderCraft
