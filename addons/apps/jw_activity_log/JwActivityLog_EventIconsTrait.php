<?php

trait EventIcons {
    /**
     * Directory for icon files
     *
     * @var string
     */
    private $icon_dir = 'assets/icons';

    /**
     * Icon file type
     *
     * @var string
     */
    private $icon_ext = '.png';

    /**
     * Map event keys to file names
     *
     * @var array
     */
    private $iconMap = array(
        'region.create'       => 'region_create',
        'region.add_item'     => 'region_add_item',
        'region.publish'      => 'region_publish',
        'item.delete'         => 'item_delete',
        'category.create'     => 'category_create',
        'category.update'     => 'category_update',
        'assets.create_image' => 'assets_create_image'
    );

    /**
     * Return icon for event type or default if none exists
     *
     * @return string
     */
    public function icon()
    {
        if(!isset($this->iconMap[$this->actionKey()])) {
            return PerchUtil::file_path($this->api->app_path() . '/' . $this->icon_dir . '/' . 'generic' . $this->icon_ext);
        }

        return PerchUtil::file_path($this->api->app_path() . '/' . $this->icon_dir . '/' . $this->iconMap[$this->actionKey()] . $this->icon_ext);
    }

    public function icons()
    {

    }
}
