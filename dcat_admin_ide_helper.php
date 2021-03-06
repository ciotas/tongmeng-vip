<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection push_api
     * @property Grid\Column|Collection points
     * @property Grid\Column|Collection crpto_max_loss
     * @property Grid\Column|Collection a_stock_max_loss
     * @property Grid\Column|Collection hk_stock_max_loss
     * @property Grid\Column|Collection us_stock_max_loss
     * @property Grid\Column|Collection fc_stock_max_loss
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection market
     * @property Grid\Column|Collection symbol
     * @property Grid\Column|Collection pair
     * @property Grid\Column|Collection quoteAsset
     * @property Grid\Column|Collection baseAsset
     * @property Grid\Column|Collection pricePrecision
     * @property Grid\Column|Collection quantityPrecision
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection exchange_id
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection period
     * @property Grid\Column|Collection image
     * @property Grid\Column|Collection tips
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection online
     * @property Grid\Column|Collection reminder_id
     * @property Grid\Column|Collection peroid
     * @property Grid\Column|Collection admin_user_id
     * @property Grid\Column|Collection remark
     * @property Grid\Column|Collection mobile
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection push_api(string $label = null)
     * @method Grid\Column|Collection points(string $label = null)
     * @method Grid\Column|Collection crpto_max_loss(string $label = null)
     * @method Grid\Column|Collection a_stock_max_loss(string $label = null)
     * @method Grid\Column|Collection hk_stock_max_loss(string $label = null)
     * @method Grid\Column|Collection us_stock_max_loss(string $label = null)
     * @method Grid\Column|Collection fc_stock_max_loss(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection market(string $label = null)
     * @method Grid\Column|Collection symbol(string $label = null)
     * @method Grid\Column|Collection pair(string $label = null)
     * @method Grid\Column|Collection quoteAsset(string $label = null)
     * @method Grid\Column|Collection baseAsset(string $label = null)
     * @method Grid\Column|Collection pricePrecision(string $label = null)
     * @method Grid\Column|Collection quantityPrecision(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection exchange_id(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection period(string $label = null)
     * @method Grid\Column|Collection image(string $label = null)
     * @method Grid\Column|Collection tips(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection online(string $label = null)
     * @method Grid\Column|Collection reminder_id(string $label = null)
     * @method Grid\Column|Collection peroid(string $label = null)
     * @method Grid\Column|Collection admin_user_id(string $label = null)
     * @method Grid\Column|Collection remark(string $label = null)
     * @method Grid\Column|Collection mobile(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection push_api
     * @property Show\Field|Collection points
     * @property Show\Field|Collection crpto_max_loss
     * @property Show\Field|Collection a_stock_max_loss
     * @property Show\Field|Collection hk_stock_max_loss
     * @property Show\Field|Collection us_stock_max_loss
     * @property Show\Field|Collection fc_stock_max_loss
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection market
     * @property Show\Field|Collection symbol
     * @property Show\Field|Collection pair
     * @property Show\Field|Collection quoteAsset
     * @property Show\Field|Collection baseAsset
     * @property Show\Field|Collection pricePrecision
     * @property Show\Field|Collection quantityPrecision
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection exchange_id
     * @property Show\Field|Collection price
     * @property Show\Field|Collection period
     * @property Show\Field|Collection image
     * @property Show\Field|Collection tips
     * @property Show\Field|Collection status
     * @property Show\Field|Collection online
     * @property Show\Field|Collection reminder_id
     * @property Show\Field|Collection peroid
     * @property Show\Field|Collection admin_user_id
     * @property Show\Field|Collection remark
     * @property Show\Field|Collection mobile
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection push_api(string $label = null)
     * @method Show\Field|Collection points(string $label = null)
     * @method Show\Field|Collection crpto_max_loss(string $label = null)
     * @method Show\Field|Collection a_stock_max_loss(string $label = null)
     * @method Show\Field|Collection hk_stock_max_loss(string $label = null)
     * @method Show\Field|Collection us_stock_max_loss(string $label = null)
     * @method Show\Field|Collection fc_stock_max_loss(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection market(string $label = null)
     * @method Show\Field|Collection symbol(string $label = null)
     * @method Show\Field|Collection pair(string $label = null)
     * @method Show\Field|Collection quoteAsset(string $label = null)
     * @method Show\Field|Collection baseAsset(string $label = null)
     * @method Show\Field|Collection pricePrecision(string $label = null)
     * @method Show\Field|Collection quantityPrecision(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection exchange_id(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection period(string $label = null)
     * @method Show\Field|Collection image(string $label = null)
     * @method Show\Field|Collection tips(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection online(string $label = null)
     * @method Show\Field|Collection reminder_id(string $label = null)
     * @method Show\Field|Collection peroid(string $label = null)
     * @method Show\Field|Collection admin_user_id(string $label = null)
     * @method Show\Field|Collection remark(string $label = null)
     * @method Show\Field|Collection mobile(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
