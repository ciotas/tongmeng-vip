<?php
namespace App\Admin\Renderable;

use App\Models\Reminder;
use App\Models\ReminderRecord;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class ReminderRecordsTable extends LazyRenderable
{
    public function render()
    {
        // 获取ID
        $id = $this->key;

        // 获取其他自定义参数
        // $type = $this->post_type;
        $data = [];

        $records = ReminderRecord::with('reminder')->where('reminder_id', $id)->orderBy('created_at', 'desc')->get()->take(5);
        foreach($records as $record)
        {
            $data[] = [
                'name' => $record->reminder->exchange->symbol,
                'price' => $record->price,
                'created_at' => $record->created_at
            ];
        }
        
        $titles = [
            '标的',
            '触发价格',
            '触发时间'
        ];

        return Table::make($titles, $data);
    }
}