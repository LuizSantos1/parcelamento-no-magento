#Magento - Parcelamento & Boleto

Módulo que exibe as formas de parcela da loja e desconto no pagamento em boleto, na tela de detalhe do produto e listagens dos produtos.

Obs.: Lembrando que o módulo só faz a exibição dos valores nas telas de listagem e detalhe do produto, porem os valores não são 
contabilizados ou integrados com o checkout, ainda. :D

##Instalação

1 - Fazer upload da pasta, na raiz do seu **Magento**.

2 - Use o código abaixo para usar o módulo na página que deseja:
```php
<?php echo $this->getChildHtml('Facilestore_Quota_ProductQuota') ?>
```

3 - Caso esteja usando um template customizado, este código acima precisa ser colocado no arquivo respectivo ao seu tema. Então nos caminhos abaixo aonde está em negrito, você deve trocar de `base/default` por `SEU_TEMA/SEU_LAYOUT`.

4 - Você pode usar este código, nas seguintes páginas:

* Página detalhe do produto:
>app/design/frontend/**base/default**/template/catalog/product/view.phtml

* Lista de produtos (Com isso já aparece na lista por categorias ou pela busca):
>app/design/frontend/**base/default**/template/catalog/product/list.phtml

5 - Limpa o cache
>Sistema (System) > Gerenciar Cache (Cache Management)

5 - Fazer logoff da administração.

6 - Configurar o módulo da forma que precisar.
>Sistema (System) > Configurações (Configuration) > Facile Store Extensions > Parcelas Produtos

##Bugs
Caso encontre algum problema com o módulo não exite em [reportá-lo](https://github.com/brunoosilva/parcelamento-no-magento/issues).

##Dúvidas e Sugestões
Tem dúvidas, sugestões ou quer apenas dar um oi, [entre em contato com o desenvolvedor](mailto:321.bruno@gmail.com).
