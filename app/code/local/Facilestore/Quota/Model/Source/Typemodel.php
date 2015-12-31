<?php
class Facilestore_Quota_Model_Source_Typemodel {
    public function toOptionArray() {
        return array(
            array(
                'value' => 'total_number',
                'label' => Mage::helper('quota')->__('Número de vezes')
            ),
            array(
                'value' => 'table',
                'label' => Mage::helper('quota')->__('Tabela de parcelamento')
            )
        );
    }
    public function toArray() {
        return array(
            'total_number' => Mage::helper('quota')->__('Número de vezes'),
            'table' => Mage::helper('quota')->__('Tabela de parcelamento')
        );
    }
}