<?php

class Facilestore_Quota_Block_Productquota extends Mage_Catalog_Block_Product_Abstract{
    protected $_configs = array();
    protected $_product = null;

    public function _construct() {
        $this->_configs['enable'] = Mage::getStoreConfig('facilestore_quota/general/enable');
        $this->_configs['qtdparcelas'] = Mage::getStoreConfig('facilestore_quota/general/qtdparcelas');
        $this->_configs['valorminimoparcela'] = Mage::getStoreConfig('facilestore_quota/general/valorminimoparcela');
        $this->_configs['juroscartao'] = Mage::getStoreConfig('facilestore_quota/general/juroscartao');
        $this->_configs['modelo'] = Mage::getStoreConfig('facilestore_quota/general/modelo');
        $this->_configs['view_produtos_txt'] = Mage::getStoreConfig('facilestore_quota/general/view_produtos_txt');
        $this->_configs['lista_produtos'] = Mage::getStoreConfig('facilestore_quota/general/lista_produtos');
        $this->_configs['lista_produtos_txt'] = Mage::getStoreConfig('facilestore_quota/general/lista_produtos_txt');
        $this->_configs['boleto_enable'] = Mage::getStoreConfig('facilestore_quota/boleto/enable');
        $this->_configs['boleto_view'] = Mage::getStoreConfig('facilestore_quota/boleto/view_enable');
        $this->_configs['boleto_list'] = Mage::getStoreConfig('facilestore_quota/boleto/list_enable');
        $this->_configs['porcentagem_boleto'] = Mage::getStoreConfig('facilestore_quota/boleto/porcentagem_boleto');
        $this->_configs['txt_boleto'] = Mage::getStoreConfig('facilestore_quota/boleto/txt_boleto');
    }

    public function isEnable(){
        return $this->_configs['enable'];
    }

    public function isBoleto(){
        if($this->_configs['boleto_enable']) {
            if($this->isCatalog() && $this->_configs['boleto_list']) {
                return true;
            }

            if(!$this->isCatalog() && $this->_configs['boleto_view']) {
                return true;
            }
        }

        return false;
    }

    public function getDescBoleto(){
        if($this->isBoleto() && $this->_configs['porcentagem_boleto']){
            $product = $this->_getProduct();
            if($product){
                $percent = $this->_configs['porcentagem_boleto'];
                $txt_boleto = $this->_configs['txt_boleto'];
                $valor = $product->getFinalPrice() - ($product->getFinalPrice() * ($percent / 100));
                $txt_boleto = str_replace("#percent#", $percent, $txt_boleto);
                $txt_boleto = str_replace("#valor#", $this->_formatPrice($valor), $txt_boleto);
                return $txt_boleto;
            }
        }
        return false;
    }

    public function getParcelas($list=false, $product = null){
		if(is_null($product)){
			$product = $this->_getProduct();
		}
        $parcelas = array();


        if($product){
            for($i=1; $i<=$this->_configs['qtdparcelas']; $i++):
                $parcela = $product->getFinalPrice() / $i;
                /*if($parcela < $this->_configs['valorminimoparcela'] && $this->_configs['juroscartao']>0){
                    $juroscartao = str_replace(",", ".", $this->_configs['juroscartao']);
                    $valor_final = $product->getFinalPrice() * pow((1 + ($juroscartao/100)), $i);
                    $parcela = $valor_final / $i;
                }*/

                if($parcela > $this->_configs['valorminimoparcela']){
                    $return = array(
                        'numero' => $i,
                        'valor_parcela' => $this->_formatPrice($parcela),
                        'valor_parcela_total' => $this->_formatPrice($i * $parcela),
                    );
                    $parcelas[] = $return;
                }
            endfor;
        }

        if($list){
            return array_pop($parcelas);
        }

        return $parcelas;
    }

    public function getModelo(){
        return $this->_configs['modelo'];
    }

    public function viewProdutosTxt(){
        $product = $this->_getProduct();
        $qtdparcelas = $this->_configs['qtdparcelas'];
        $parcela = $this->getParcelas(true);

        $lista_txt = $this->_configs['view_produtos_txt'];
        $lista_txt = str_replace("#qtd#", $parcela['numero'], $lista_txt);
        $lista_txt = str_replace("#valor#", $parcela['valor_parcela'], $lista_txt);

        return $lista_txt;
    }

    public function listaProdutosTxt(){
        $product = $this->_getProduct();
        $qtdparcelas = $this->_configs['qtdparcelas'];
        $parcela = $this->getParcelas(true);

        $lista_txt = $this->_configs['lista_produtos_txt'];
        $lista_txt = str_replace("#qtd#", $parcela['numero'], $lista_txt);
        $lista_txt = str_replace("#valor#", $parcela['valor_parcela'], $lista_txt);

        return $lista_txt;
    }

    public function _getProduct(){
        if(!is_null($this->_product)){
            return $this->_product;
        }

        if($this->getProduct()){
            return $this->getProduct();
        } elseif(Mage::registry('current_product')){
            return Mage::registry('current_product');
        }
    }

    public function _setProduct($product){
        $this->_product = $product;
    }

    public function _formatPrice($price){
        return Mage::helper('core')->currency($price, true, false);
    }

    public function isCatalog(){
        $onCatalog = true;
        if(Mage::registry('current_product')) {
            $onCatalog = false;
        }
        return $onCatalog;
    }

    public function getProductType(){
        $product_type = "";

        $_product = $this->_getProduct();

        if($_product && is_array($_product->getCategoryIds()) && count($_product->getCategoryIds())){
            $category = Mage::getModel('catalog/category')->load(7);
            $sub_category = explode(",", $category->getChildren());
            if(is_array($sub_category) && count($sub_category)){
                $diff = array_intersect($_product->getCategoryIds(), $sub_category);
                if(count($diff)){
                    $category_id = array_shift($diff);
                    $category = Mage::getModel('catalog/category')->load($category_id);
                    $product_type = $category->getName();
                }
            }
        }

        return $product_type;
    }
}
