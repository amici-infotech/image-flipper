<?php
namespace Amici\ImageFlipper\Plugin;

use Closure;
use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\NoSuchEntityException;
use Amici\ImageFlipper\ViewModel\ConfigurableFlipper;

/**
 * Class Plugin Of Abstract Product List
 */
class AbstractProductList
{
    /**
     * @var ConfigurableFlipper
     */
    private ConfigurableFlipper $viewModel;

    /**
     * Abstract Product List Constructor
     *
     * @param ConfigurableFlipper $viewModel
     */
    public function __construct(
        ConfigurableFlipper $viewModel
    ) {
        $this->viewModel = $viewModel;
    }

    /**
     * Around Get Product Details Html
     *
     * @param AbstractProduct $subject
     * @param Closure $proceed
     * @param Product $product
     * @return string
     * @throws NoSuchEntityException
     */
    public function aroundGetProductDetailsHtml(
        AbstractProduct $subject,
        Closure         $proceed,
        Product         $product
    ): string {
        if ($this->viewModel->getModuleEnable()) {
            $flipper_img_name = $product->getData('flipper_image');
            if (($flipper_img_name != "no_selection")
                && ($flipper_img_name != "productno_selection")
                && (($flipper_img_name != null))) {
                $image_url = $this->viewModel->getMediaPath() . 'catalog/product' . $flipper_img_name;
                $result = $proceed($product);
                $type = $product->getTypeId();
                return $result . '<span id="amici_flipper_img" style="display:none;"  data-type="' 
                . $type . '">' . $image_url . '</span>';
            }
        }
        return $proceed($product);
    }
}
