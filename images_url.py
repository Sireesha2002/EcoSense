import pandas as pd

# Load the dataset
file_path = 'skincare_products_with_category_specific_ingredients.csv'  # Replace with your actual file path
df = pd.read_csv(file_path)

# Extract unique values for each column
unique_brands = df['brand_name'].unique()
unique_product_names = df['product_name'].unique()
unique_product_values = df.nunique()
unique_categories = df['category'].unique()  # Replace 'category' with the actual column name for categories if different

# Print the unique values
print("Unique Brands:")
print(unique_brands)

print("\nUnique Product Names:")
print(unique_product_names)

print("\nUnique Categories:")
print(unique_categories)

print("\nNumber of Product Values")
print(unique_product_values)
