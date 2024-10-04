FROM gitasap.ru:5050/it/gosti/front:0.1.4 as front
WORKDIR /app
COPY ../front ./
RUN npm install
RUN npm run build

FROM gitasap.ru:5050/it/gosti/back:0.1.4 as back
WORKDIR /app
COPY ../back ./
RUN npm install
RUN npm run build
