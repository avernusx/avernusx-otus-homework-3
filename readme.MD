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

helm repo add stable https://charts.helm.sh/stable
kubectl create namespace monitoring
helm install prom stable/prometheus-operator -f ./manifests/prometheus.yaml --atomic --namespace=monitoring
helm install nginx stable/nginx-ingress -f ./manifests/ingress.yaml --atomic


grafana: admin / prom-operator
kubectl port-forward --namespace=monitoring service/prom-grafana 9000:80 
kubectl port-forward --namespace=monitoring service/prom-prometheus-operator-prometheus 9090
kubectl apply -f ./manifests/grafana.yaml --namespace=monitoring