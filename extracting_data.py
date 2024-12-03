import pandas as pd

# Load the dataset
file_path = 'skincare_products_with_category_specific_ingredients.csv'  # Replace with the path to your dataset
df = pd.read_csv(file_path)

# Filter rows of your desired category
cleanser_rows = df[df['category'].str.contains('Cleanser', case=False, na=False)].head(30).iloc[:, :3]

# Display the filtered rows
print(cleanser_rows)