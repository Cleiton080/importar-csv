# Importar-csv

## 👨🏻‍🔧 Install

You can just install using composer as shown bellow

```
composer require cleiton080/spreadsheet
```

Now you're ready to go 🥳🎉! 

## 🚀 Usage

With the package properly set up you can use it either to read the csv and save it somewhere else or get a set of data and turn it into a csv file as we will see later on.

### Import

In this example we are going to see, what would it looks like if you have a csv file and wanted to save it into a database.

```
$csv = new \Cleiton080\Csv\Import;

$csv->load(storage_path('product.csv'));

// The callback you passed through the import method will be execute for each row,
// the row parameter represents the row and its position represents the column
$csv->import(function ($row) use ($product) {
    $product->create([
        'id' => $row[0],
        'name' => $row[1],
        'price' => $row[2]
    ]);
});

```

### Export

Let's do the opposite, now we have some records in our database and we want to save it into a csv file.

```
$product = new App\Models\Product;
$csv = new \Cleiton080\Csv\Export;

$products = $product->all();

$csv->exportAt(
    $products->toArray(),
    storage_path('product.csv')
);
```

## 👨‍🔬 Test

```
composer run-script test
```
