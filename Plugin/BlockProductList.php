<?php
namespace Amici\ImageFlipper\Plugin;

use Closure;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\NoSuchEntityException;
use Amici\ImageFlipper\ViewModel\ConfigurableFlipper;

/**
 * Class Plugin Of Block Product List
 */
class BlockProductList
{
    /**
     * @var ConfigurableFlipper
     */
    private ConfigurableFlipper $viewModel;

    /**
     * Block Product List Constructor
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
     * @param ListProduct $subject
     * @param Closure $proceed
     * @param Product $product
     * @return string
     * @throws NoSuchEntityException
     */
    public function aroundGetProductDetailsHtml(
        ListProduct $subject,
        Closure     $proceed,
        Product     $product
    ): string {
        if ($this->viewModel->getModuleEnable()) {
            $flipper_img_name = $product->getData('flipper_image');
            if (($flipper_img_name != "no_selection")
                && ($flipper_img_name != "productno_selection")
                && (($flipper_img_name != null))) {
                $image_url = $this->viewModel->getMediaPath() . 'catalog/product' . $flipper_img_name;
                $result = $proceed($product);
                return $result . '<span id="amici_flipper_img" style="display:none;">' . $image_url . '</span>';
            }
        }
        return $proceed($product);
    }
}
