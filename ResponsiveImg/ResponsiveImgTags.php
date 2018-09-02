<?php

namespace Statamic\Addons\ResponsiveImg;

use Statamic\API\Asset;
use Statamic\Extend\Tags;

class ResponsiveImgTags extends Tags
{
    /**
     * Handle {{ responsive_img:[name] }} tags
     *
     * @return string
     */
    public function __call($name, $args)
    {
        $image = array_get($this->context, $this->tag_method);

        if (! $image = Asset::find($image ?: $this->get('image'))) {
            return null;
        }

        return $this->view('img', [
            'attrs' => $this->getAttributeString(),
            'srcset' => Image::getSrcset($image, $this->get('quality', 75))
        ]);
    }
}