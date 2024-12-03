import pandas as pd
import os

# Load the dataset
file_path = 'skincare_products_with_category_specific_ingredients.csv'
df = pd.read_csv(file_path)

# Path to the main image folder
image_base_folder = 'images'

# Function to map images based on category
def map_images_by_category(row):
    # Get the category from the dataset and map it to the folder
    category = row['category']
    category_folder = os.path.join(image_base_folder, category)

    if os.path.exists(category_folder):
        # List all images in the category folder
        images = os.listdir(category_folder)
        # Use the index to pick an image cyclically (e.g., first image for the first product, repeat if necessary)
        image_index = row.name % len(images)  # Use modulo to avoid out-of-range errors
        return os.path.join(category_folder, images[image_index])
    else:
        return None  # Return None if the category folder doesn't exist

# Apply the mapping function
df['image_path'] = df.apply(map_images_by_category, axis=1)

# Save the updated dataset
output_file = 'updated_dataset_with_image_paths.csv'
df.to_csv(output_file, index=False)

# Display a sample of the updated dataset
print(df.head())
