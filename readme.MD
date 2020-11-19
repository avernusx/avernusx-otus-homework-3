# Установка приложения
```
helm repo add bitnami https://charts.bitnami.com/bitnami
helm install -f ./manifests/values.yaml postgres-db bitnami/postgresql
kubectl apply -f ./manifests/migrations
kubectl apply -f ./manifests/all
```
# Установка приложения через helm
```
helm dependency update ./helm-chart
helm install oapp ./helm-chart
```