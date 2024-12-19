import pandas as pd

# Load the CSV dataset
file_path = 'synthetic_lifecycle_data.csv'  # Replace with your file path
data = pd.read_csv(file_path)

# Save it as a JSON file
output_json_path = 'synthetic_lifecycle_data.json'  # Replace with desired output path
data.to_json(output_json_path, orient='records', lines=False)

print(f"JSON file saved at: {output_json_path}")