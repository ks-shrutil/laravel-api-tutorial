<?php

namespace App\Http\Filters\V1;


class AuthorFilter extends QueryFilter
{
    protected $sortable = [
        'name',
        'email',
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
    public function id($value)
    {
        return $this->builder->whereIn('id', explode(',', $value));
    }




    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function email($value)
    {
        $likeStr = str_replace('*', '%', $value);

        return $this->builder->where('email', 'like', $likeStr);
    }


    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function name($value)
    {
        $likeStr = str_replace('*', '%', $value);

        return $this->builder->where('name', 'like', $likeStr);
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
