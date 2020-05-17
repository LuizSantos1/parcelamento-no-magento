#Magento - Parcelamento & Boleto

Módulo que exibe as formas de parcela da loja e desconto no pagamento em boleto, na tela de detalhe do produto e listagens dos produtos.

Obs.: Lembrando que o módulo só faz a exibição dos valores nas telas de listagem e detalhe do produto, porem os valores não são 
contabilizados ou integrados com o checkout, ainda. :D

##Instalação

1 - Fazer upload da pasta, na raiz do seu **Magento**.

2 - Use o código abaixo para usar o módulo na página que deseja:
```php
<?php echo $this->getLayout()->getBlock('Facilestore_Quota_ProductQuota')->setProduct($_product)->toHtml(); ?>
```
3 - Sugiro colocar no **price.phtml** do Magento, assim em todos os lugares que mostrar o preço, irá mostrar as parcelas. Para isso, você edita o arquivo a abaixo e coloque o código acima, dentro da `<div class="price-box">`aonde você achar melhor para colocar o style depois: 

* Página detalhe do produto:
>app/design/frontend/**base/default**/template/catalog/product/price.phtml

4 - Mas se não quiser o modo acima, pode mexer somente no template de list e view. Caso esteja usando um template customizado, este código acima precisa ser colocado no arquivo respectivo ao seu tema. Então nos caminhos abaixo aonde está em negrito, você deve trocar de `base/default` por `SEU_TEMA/SEU_LAYOUT`.

5 - Você pode usar este código, nas seguintes páginas:

* Página detalhe do produto:
>app/design/frontend/**base/default**/template/catalog/product/view.phtml

* Lista de produtos (Com isso já aparece na lista por categorias ou pela busca):
>app/design/frontend/**base/default**/template/catalog/product/list.phtml

6 - Limpa o cache
>Sistema (System) > Gerenciar Cache (Cache Management)

7 - Fazer logoff da administração.

8 - Configurar o módulo da forma que precisar.
>Sistema (System) > Configurações (Configuration) > Facile Store Extensions > Parcelas Produtos

##Bugs
Caso encontre algum problema com o módulo não exite em [reportá-lo](https://github.com/brunoosilva/parcelamento-no-magento/issues).

##Dúvidas e Sugestões
Tem dúvidas, sugestões ou quer apenas dar um oi, [entre em contato com o desenvolvedor](mailto:321.bruno@gmail.com).
