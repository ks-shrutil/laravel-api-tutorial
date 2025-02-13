<?php

namespace App\Http\Filters\V1;


class TicketFilter extends QueryFilter
{
    protected $sortable = [
        'title',
        'status',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];


    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function createdAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }
        return $this->builder->whereDate('created_at', $value);
    }



    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function include($value)
    {
        return $this->builder->with($value);
    }



    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function status($value)
    {
        return $this->builder->whereIn('status', explode(',', $value));
    }



    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function title($value)
    {
        $likeStr = str_replace('*', '%', $value);

        return $this->builder->where('title', 'like', $likeStr);
    }



    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function updatedAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }
        return $this->builder->whereDate('created_at', $value);
    }
}
