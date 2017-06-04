﻿<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
DB::table('categories')->insert([

                [
                    'name' => 'নগদ প্রাপ্তি',
                    'ie' => '0',
                ],
                [
                    'name' => 'রপ্তানি',
                    'ie' => '0',
                ],
                [
                    'name' => 'ক্যাশ সাবসিডি',
                    'ie' => '0',
                ],
                [
                    'name' => 'কৃষি',
                    'ie' => '0',
                ],
                [
                    'name' => 'পুকুর',
                    'ie' => '0',
                ],
                [
                    'name' => 'লোহা',
                    'ie' => '0',
                ],
                [
                    'name' => 'নষ্ট কাগজ',
                    'ie' => '0',
                ],
                [
                    'name' => 'নষ্ট পলিথিন',
                    'ie' => '0',
                ],
                [
                    'name' => 'নষ্ট প্লাস্টিক',
                    'ie' => '0',
                ],
                [
                    'name' => 'নষ্ট স্লাইভার ক্যান',
                    'ie' => '0',
                ],
                [
                    'name' => 'স্ক্রাব',
                    'ie' => '0',
                ],
                [
                    'name' => 'বাবরি',
                    'ie' => '0',
                ],
                [
                    'name' => 'নষ্ট পিন',
                    'ie' => '0',
                ],
                [
                    'name' => 'নষ্ট কাঠ',
                    'ie' => '0',
                ],
                [
                    'name' => 'গদ্দা',
                    'ie' => '0',
                ],
                [
                    'name' => 'নষ্ট কয়লা',
                    'ie' => '0',
                ],
                [
                    'name' => 'অন্যান্য অবাবহ্রিত দ্রব্যাদি',
                    'ie' => '0',
                ],
                [
                    'name' => 'অন্যান্য আয়',
                    'ie' => '0',
                ],
                [
                    'name' => 'কাঁচা পাট',
                    'ie' => '1',
                ],
                [
                    'name' => 'ষ্টাফ বেতন',
                    'ie' => '1',
                ],
                [
                    'name' => 'শ্রমিক মজুরী',
                    'ie' => '1',
                ],
                [
                    'name' => 'খুচরা যন্ত্রাংশ',
                    'ie' => '1',
                ],
                [
                    'name' => 'বৈদ্যুতিক মালামাাল',
                    'ie' => '1',
                ],
                [
                    'name' => 'জেবিও',
                    'ie' => '1',
                ],
                [
                    'name' => 'ম্যাকরোল',
                    'ie' => '1',
                ],
                [
                    'name' => 'মবিল',
                    'ie' => '1',
                ],
                [
                    'name' => 'ডিজেল',
                    'ie' => '1',
                ],
                [
                    'name' => 'কেরোসিন',
                    'ie' => '1',
                ],
                [
                    'name' => 'সয়াবিন',
                    'ie' => '1',
                ],
                [
                    'name' => 'ট্রাক ভাড়া',
                    'ie' => '1',
                ],
                [
                    'name' => 'চটের বস্তা',
                    'ie' => '1',
                ],
                [
                    'name' => 'পলিথিন',
                    'ie' => '1',
                ],
                [
                    'name' => 'ষ্টেশনারী',
                    'ie' => '1',
                ],
                [
                    'name' => 'কাঠের স্পুল',
                    'ie' => '1',
                ],
                [
                    'name' => 'ষ্টাফ গমনাগমন',
                    'ie' => '1',
                ],
                [
                    'name' => 'শ্রমিক গমনাগমন',
                    'ie' => '1',
                ],
                [
                    'name' => 'বিদ্যুৎ বিল',
                    'ie' => '1',
                ],
                [
                    'name' => 'স্লাইভার ক্যান',
                    'ie' => '1',
                ],
                [
                    'name' => 'ডানেজ তৈরী ও মেরামত',
                    'ie' => '1',
                ],
                [
                    'name' => 'আপ্যায়ন',
                    'ie' => '1',
                ],
                [
                    'name' => 'অনলাইন বাবদ',
                    'ie' => '1',
                ],
                [
                    'name' => 'চিকিৎসা ব্যয়',
                    'ie' => '1',
                ],
                [
                    'name' => 'লাইসেন্স নবায়ন',
                    'ie' => '1',
                ],
                [
                    'name' => 'মেরামত',
                    'ie' => '1',
                ],
                [
                    'name' => 'স্প্যান্ডেল অয়েল',
                    'ie' => '1',
                ],
                [
                    'name' => 'গ্রীজ',
                    'ie' => '1',
                ],
                [
                    'name' => 'নিকালিন',
                    'ie' => '1',
                ],
                [
                    'name' => 'স্লাইভার ক্যান',
                    'ie' => '1',
                ],
                [
                    'name' => 'স্পুল',
                    'ie' => '1',
                ],
                [
                    'name' => 'সি এন্ড এফ বিল',
                    'ie' => '1',
                ],
                [
                    'name' => 'অন্যান্য ব্যয়',
                    'ie' => '1',
                ],

            ]);
    }
}