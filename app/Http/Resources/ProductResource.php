<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'custom_article_number' => $this->custom_article_number,
            'article_number' => $this->article_number,
            'image' => $this->when($this->image, function () {
                return $this->image_url;
            }),
            'pzn' => $this->pzn,
            'descriptions' => [
                'description_1' => $this->article_description_1,
                'description_2' => $this->article_description_2,
                'description_3' => $this->article_description_3,
            ],
            'price_unit' => $this->price_unit,
            'minimum_order_quantity' => $this->minimum_order_quantity,
            'quantity_unit' => $this->quantity_unit,
            'tax_code' => $this->tax_code,
            'retail_price' => $this->retail_price,
            'sales_price' => $this->sales_price,
            'tier_code' => $this->tier_code,
            'pricing' => [
                [
                    'quantity_value' => $this->quantity_value_1,
                    'net_price_discount' => $this->net_price_discount_1,
                ],
                [
                    'quantity_value' => $this->quantity_value_2,
                    'net_price_discount' => $this->net_price_discount_2,
                ],
                [
                    'quantity_value' => $this->quantity_value_3,
                    'net_price_discount' => $this->net_price_discount_3,
                ],
            ],
            'is_new' => $this->is_new,
            'date_new_entry' => $this->date_new_entry,
            'price_changed' => $this->price_changed,
            'date_last_price_change' => $this->date_last_price_change,
            'non_discountable' => $this->non_discountable,
            'promotion_price' => $this->promotion_price,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
            'gtin' => $this->gtin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'seo_field' =>
                [
                    "meta_title" => $this->seo_field?->meta_title ?? null,
                    "meta_description" => $this->seo_field?->meta_description ?? null,
                ],

            'FilterWordsDE' => $this->getTranslationValue('FilterWords', 'DE'),
            'FilterWordsEN' => $this->getTranslationValue('FilterWords', 'EN'),
            'FilterWordsFR' => $this->getTranslationValue('FilterWords', 'FR'),
            'FilterWordsIT' => $this->getTranslationValue('FilterWords', 'IT'),
            'ProductNameDE' => $this->getTranslationValue('ProductName', 'DE'),
            'ProductNameEN' => $this->getTranslationValue('ProductName', 'EN'),
            'ProductNameFR' => $this->getTranslationValue('ProductName', 'FR'),
            'ProductNameIT' => $this->getTranslationValue('ProductName', 'IT'),
            'ProductDescriptionDE' => $this->getTranslationValue('Description', 'DE'),
            'ProductDescriptionEN' => $this->getTranslationValue('Description', 'EN'),
            'ProductDescriptionFR' => $this->getTranslationValue('Description', 'FR'),
            'ProductDescriptionIT' => $this->getTranslationValue('Description', 'IT'),
            'HTML-DescriptionDE' => $this->getTranslationValue('HTML_Description', 'DE'),
            'HTML-DescriptionEN' => $this->getTranslationValue('HTML_Description', 'EN'),
            'HTML-DescriptionFR' => $this->getTranslationValue('HTML_Description', 'FR'),
            'HTML-DescriptionIT' => $this->getTranslationValue('HTML_Description', 'IT'),
            'META-DescriptionDE' => $this->getTranslationValue('META_Description', 'DE'),
            'META-DescriptionEN' => $this->getTranslationValue('META_Description', 'EN'),
            'META-DescriptionFR' => $this->getTranslationValue('META_Description', 'FR'),
            'META-DescriptionIT' => $this->getTranslationValue('META_Description', 'IT'),
            'KEYWORD-DescriptionDE' => $this->getTranslationValue('KEYWORD_Description', 'DE'),
            'KEYWORD-DescriptionEN' => $this->getTranslationValue('KEYWORD_Description', 'EN'),
            'KEYWORD-DescriptionFR' => $this->getTranslationValue('KEYWORD_Description', 'FR'),
            'KEYWORD-DescriptionIT' => $this->getTranslationValue('KEYWORD_Description', 'IT'),
            'SEARCHWORDS-DescriptionDE' => $this->getTranslationValue('SEARCHWORDS_Description', 'DE'),
            'SEARCHWORDS-DescriptionEN' => $this->getTranslationValue('SEARCHWORDS_Description', 'EN'),
            'SEARCHWORDS-DescriptionFR' => $this->getTranslationValue('SEARCHWORDS_Description', 'FR'),
            'SEARCHWORDS-DescriptionIT' => $this->getTranslationValue('SEARCHWORDS_Description', 'IT'),
            'CategoryDescriptionDE' => $this->getCategoryValue('CategoryDescription', 'DE'),
            'CategoryDescriptionEN' => $this->getCategoryValue('CategoryDescription', 'EN'),
            'CategoryDescriptionFR' => $this->getCategoryValue('CategoryDescription', 'FR'),
            'CategoryDescriptionIT' => $this->getCategoryValue('CategoryDescription', 'IT'),
            'CategoryKeywordDE' => $this->getCategoryValue('CategoryKeyword', 'DE'),
            'CategoryKeywordEN' => $this->getCategoryValue('CategoryKeyword', 'EN'),
            'CategoryKeywordFR' => $this->getCategoryValue('CategoryKeyword', 'FR'),
            'CategoryKeywordIT' => $this->getCategoryValue('CategoryKeyword', 'IT'),
            'CategoryTitleDE' => $this->getCategoryValue('CategoryTitle', 'DE'),
            'CategoryTitleEN' => $this->getCategoryValue('CategoryTitle', 'EN'),
            'CategoryTitleFR' => $this->getCategoryValue('CategoryTitle', 'FR'),
            'CategoryTitleIT' => $this->getCategoryValue('CategoryTitle', 'IT'),
            'CategoryURLDE' => $this->getCategoryValue('CategoryURL', 'DE'),
            'CategoryURLEN' => $this->getCategoryValue('CategoryURL', 'EN'),
            'CategoryURLFR' => $this->getCategoryValue('CategoryURL', 'FR'),
            'CategoryURLIT' => $this->getCategoryValue('CategoryURL', 'IT'),
            'CategoryLevel1DE' => $this->getCategoryValue('CategoryLevel1', 'DE'),
            'CategoryLevel2DE' => $this->getCategoryValue('CategoryLevel2', 'DE'),
            'CategoryLevel3DE' => $this->getCategoryValue('CategoryLevel3', 'DE'),
            'CategoryLevel4DE' => $this->getCategoryValue('CategoryLevel4', 'DE'),
            'CategoryLevel1FR' => $this->getCategoryValue('CategoryLevel1', 'FR'),
            'CategoryLevel2FR' => $this->getCategoryValue('CategoryLevel2', 'FR'),
            'CategoryLevel3FR' => $this->getCategoryValue('CategoryLevel3', 'FR'),
            'CategoryLevel4FR' => $this->getCategoryValue('CategoryLevel4', 'FR'),
            'CategoryLevel1EN' => $this->getCategoryValue('CategoryLevel1', 'EN'),
            'CategoryLevel2EN' => $this->getCategoryValue('CategoryLevel2', 'EN'),
            'CategoryLevel3EN' => $this->getCategoryValue('CategoryLevel3', 'EN'),
            'CategoryLevel4EN' => $this->getCategoryValue('CategoryLevel4', 'EN'),
            'CategoryLevel1IT' => $this->getCategoryValue('CategoryLevel1', 'IT'),
            'CategoryLevel2IT' => $this->getCategoryValue('CategoryLevel2', 'IT'),
            'CategoryLevel3IT' => $this->getCategoryValue('CategoryLevel3', 'IT'),
            'CategoryLevel4IT' => $this->getCategoryValue('CategoryLevel4', 'IT'),
        ];
    }
    private function getTranslationValue($field, $lang)
    {
        return $this->translations->firstWhere('LanguageCode', $lang)->{$field} ?? '';
    }

    private function getCategoryValue($field, $lang)
    {
        return $this->categoryTranslations->firstWhere('CategoryLanguageCode', $lang)->{$field} ?? '';
    }
}
