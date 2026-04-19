document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const itemsGrid = document.getElementById('itemsGrid');

    const loadItems = async (searchQuery = '') => {
        try {
            const response = await fetch(`fetch_items.php?q=${encodeURIComponent(searchQuery)}`);
            const items = await response.json();

            if (items.length === 0) {
                itemsGrid.innerHTML = '<p style="color:gray; grid-column: 1/-1; text-align:center;">No approved items found matching your search.</p>';
                return;
            }

            itemsGrid.innerHTML = items.map(item => `
                <div class="glass-card">
                    <span class="badge ${item.type.toLowerCase() === 'lost' ? 'lost' : 'found'}" 
                          style="background: ${item.type === 'Lost' ? '#ff4757' : '#2ed573'}; 
                                 padding: 5px 10px; border-radius: 5px; font-size: 0.8em;">
                        ${item.type}
                    </span>
                    
                    ${item.image_path ? 
                        `<img src="${item.image_path}" style="width:100%; height:180px; object-fit:cover; border-radius:10px; margin: 15px 0;">` : 
                        `<div style="height:180px; background: rgba(255,255,255,0.05); border-radius:10px; margin: 15px 0; display:flex; align-items:center; justify-content:center; color:gray;">No Image</div>`
                    }
                    
                    <h3 style="margin: 0; color: #e94560;">${item.title}</h3>
                    <p style="font-size: 0.9em; opacity: 0.8; height: 40px; overflow: hidden;">${item.description}</p>
                    <p style="font-size: 0.8em; color: #4ecca3;">📍 ${item.location_found}</p>
                    <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size: 0.7em; opacity: 0.6;">By: ${item.poster_name}</span>
                        <button class="btn-claim" onclick="alert('Verification system coming in Phase 3!')">View Details</button>
                    </div>
                </div>
            `).join('');
        } catch (err) {
            console.error('Error loading feed:', err);
        }
    };

    searchInput.addEventListener('input', (e) => loadItems(e.target.value));
    loadItems();
});
