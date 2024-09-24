import requests

def search_university_emblem_google(university_name, api_key, cx):
    search_url = "https://www.googleapis.com/customsearch/v1"
    
    # Define the parameters for the Google Custom Search API
    params = {
        'q': f"{university_name} emblem",  # Changed 'logo' to 'emblem'
        'searchType': 'image',
        'key': api_key,
        'cx': cx,  # Your custom search engine ID
        'num': 3   # Limit to 3 results
    }

    try:
        # Make a GET request to the Google Custom Search API
        response = requests.get(search_url, params=params)
        response.raise_for_status()

        # Parse the JSON response
        search_results = response.json()
        if 'items' in search_results:
            for i, item in enumerate(search_results['items']):
                emblem_url = item['link']
                print(f"Emblem {i + 1} for {university_name}: {emblem_url}")
            return [item['link'] for item in search_results['items']]
        else:
            print(f"No emblems found for {university_name}.")
            return None
    except requests.exceptions.RequestException as e:
        print(f"Error fetching data from Google API: {e}")
        return None

# Example search (provide your Google API key and Custom Search Engine ID)
university_name = "University of Texas"
api_key = "AIzaSyDLmFFsLMzbTAs2ToYTPnSjcbgl9BKN5Xk"  # Replace with your Google API key
cx = "f68e9e7edff744ca1"     # Replace with your custom search engine ID
emblems = search_university_emblem_google(university_name, api_key, cx)
