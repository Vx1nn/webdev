// form-handler.js
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Processing...';
                

                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = submitBtn.dataset.originalText || 'Save';
                }, 3000);
            }
        });
        
        const submitBtn = form.querySelector('[type="submit"]');
        if (submitBtn) {
            submitBtn.dataset.originalText = submitBtn.innerHTML;
        }
    });
});
