document.addEventListener("DOMContentLoaded", function() {
    const voteForm = document.querySelector("form");
    
    if (voteForm) {
        voteForm.addEventListener("submit", function(event) {
            const selectedCandidate = document.querySelector("input[name='candidate']:checked");
            
            if (!selectedCandidate) {
                event.preventDefault();
                alert("Please select a candidate before submitting your vote.");
            }
        });
    }
});
