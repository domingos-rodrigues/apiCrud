<?php
namespace Categories;

/**
 * Class Category
 * @package Categories
 */
class Category
{
    /**
     * @param $cat
     * @return mixed
     */
    public function createCategory($cat)
    {
        $cat['id'] = (int)$cat['id'];
        if (is_null($this->getCategoryById($cat['id']))){
            $categories = Category::getCategories();
            $cat['category_id'] = (int)$cat['category_id'] ;
            $cat['created'] = $cat['modified'] = date("Y-m-d H:i:s");
            $cat['subcategories'] = [];
            $categories[] = $cat;
            Category::jsonSave($categories);
        }
        return $cat;

    }

    public function createSubCategory($cat, $id)
    {
        $categories = Category::getCategories();

        $cat['created'] = $cat['modified'] = date("Y-m-d H:i:s");
        $cat['id'] = (int)$cat['id'];
        $cat['category_id'] = (int)$cat['category_id'];
        foreach ($categories as $idx => $category) {
            if ($category['id'] == $id) {
                $existId = false;
                foreach ($category as $fieldSub ) {
                    if ($fieldSub['id'] == $cat['id']) {
                        $existId = true;
                        break;
                    }
                }
                if(!$existId)
                    $categories[$idx]['subcategories'][] = $cat;
                break;
            }
        }

        Category::jsonSave($categories);
        return $cat;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return json_decode(file_get_contents(__DIR__ . '/categorySubcategory.json'), true );
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function getCategoryById($id)
    {
        $categories = Category::getCategories();
        foreach ($categories as $category) {
            if ($category['id'] == $id)
                return $category;
        }
        return null;
    }

    /**
     * @param $id
     * @param $idSub
     * @return mixed|null
     */
    public function getSubCategoryById($id, $idSub)
    {
        $categories = Category::getCategories();
        foreach ($categories as $idx => $category) {
            if ($category['category_id'] == $id) {
                foreach ($category['subcategories'] as $idxSub => $fieldSub)
                    if ($fieldSub['id'] == $idSub)
                        return $fieldSub;
                break;
            }
        }
        return null;
    }

    /**
     * procura muito simples pelo primeiro caso
     *
     *
     * @param $search
     * @return mixed|null
     */
    public function searchCat($search)
    {
        $categories = Category::getCategories();
        foreach ($categories as $category) {
            if (strpos( $category['name'], $search ) !== false)
                return $category;
        }
        return null;
    }

    /**
     * @param $id
     * @param $cat
     * @return array
     */
    public function updateCategory($id, $cat)
    {
        $updateCat = [];
        $categories = Category::getCategories();
        foreach ($categories as $idx => $category) {
            if ($category['id'] == $id) {
                $categories[$idx]['modified'] = $cat['modified'] = date("Y-m-d H:i:s");
                $categories[$idx]['name'] = $cat['name'];
                if (count($categories[$idx]['subcategories'])==0)
                    $categories[$idx]['category_id'] = (int)$cat['category_id'];
                break;
            }
        }
        Category::jsonSave($categories);

        return $updateCat;
    }

    /**
     * @param $id
     * @param $cat
     * @return array
     */
    public function updateSubCategory($id, $cat)
    {
        $updateCat = [];
        $categories = Category::getCategories();
        foreach ($categories as $idx => $category) {
            if ($category['id'] == $id) {
                $categories[$idx]['modified'] = $cat['modified'] = date("Y-m-d H:i:s");
                $categories[$idx]['name'] = $cat['name'];
//                if (count($categories[$idx]['subcategories'])==0)
//                    $categories[$idx]['category_id'] = (int)$cat['category_id'];
                break;
            }
        }
        Category::jsonSave($categories);

        return $updateCat;
    }

    /**
     * @param $id
     */
    public function deleteCategory($id)
    {
        $categories = Category::getCategories();
        foreach ($categories as $idx => $category) {
            if ($category['id'] == $id) {
                array_splice($categories, $idx, 1);
                break;
            }
        }
        Category::jsonSave($categories);
    }

    /**
     * @param $id
     * @param $idSub
     */
    public function deleteSubCategory($id, $idSub)
    {
        $categories = Category::getCategories();
        foreach ($categories as $idx => $category) {
            if ($category['category_id'] == $id) {
                //$existId = false;
                foreach ($category['subcategories'] as $idxSub => $fieldSub )
                    if ($fieldSub['id'] == $idSub) {
                        //$existId = true;
                        unset($categories[$idx]['subcategories'][$idxSub]);
                        break;
                    }
                break;
            }
        }
        Category::jsonSave($categories);
    }

    /**
     * @param $cat
     * @param $errors
     * @return bool
     */
    public function validateCategory($cat, &$errors)
    {
        $valid = true;

        if (!$cat['id'] || !is_int($cat['id']+0)) {
            $valid = false;
            $errors['id'] = 'id is mandatory';
        }

        if (!$cat['category_id']) {
            $valid = false;
            $errors['category_id'] = 'category_id is mandatory';
        } else if(!is_int($cat['category_id']+0)){
            $valid = false;
            $errors['category_id'] = 'category_id must be integer';
            $cat['category_id'] = 0;
        }

        if (!$cat['name']) {
            $valid = false;
            $errors['name'] = 'name is mandatory';
        }
        /*if (!$cat['created']) {
            $valid = false;
            $errors['created'] = 'name is mandatory';
        }*/
        /*if (!$cat['modified']) {
            $valid = false;
            $errors['modified'] = 'name is mandatory';
        }*/
        return $valid;
    }

    /**
     * @param $cat
     * @param $errors
     * @return bool
     */
    public function validateSubCategory($cat, &$errors)
    {
        $valid = true;

        if (!$cat['id'] || !is_int($cat['id']+0)) {
            $valid = false;
            $errors['id'] = 'id is mandatory';
        }

/*        if (!$cat['category_id']) {
            $valid = false;
            $errors['category_id'] = 'category_id is mandatory';
        } else if(!is_int($cat['category_id']+0)){
            $valid = false;
            $errors['category_id'] = 'category_id must be integer';
            $cat['category_id'] = 0;
        }*/

        if (!$cat['name']) {
            $valid = false;
            $errors['name'] = 'name is mandatory';
        }
        /*if (!$cat['created']) {
            $valid = false;
            $errors['created'] = 'name is mandatory';
        }*/
        /*if (!$cat['modified']) {
            $valid = false;
            $errors['modified'] = 'name is mandatory';
        }*/

        return $valid;
    }

    /**
     * @param $categories
     */
    public function jsonSave($categories)
    {
        $file = __DIR__ . '/categorySubcategory.json';
        if (!is_writable($file)){
            chmod($file, 0666);
        }
        file_put_contents($file, json_encode($categories, JSON_PRETTY_PRINT));
    }

}