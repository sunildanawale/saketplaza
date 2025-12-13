// Highlight active nav link
const currentPage = window.location.pathname.split('/').pop();
document.querySelectorAll('nav a').forEach(link => {
  link.classList.toggle('active', link.href.includes(currentPage));
});

// Back to Top
const backToTop = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
  backToTop.style.display = window.scrollY > 200 ? 'flex' : 'none';
});
backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

// Lightbox Image Preview
const lightbox = document.getElementById('lightbox');
const lightboxImg = lightbox.querySelector('img');

document.querySelectorAll('.room-card img').forEach(img => {
  img.addEventListener('click', () => {
    lightboxImg.src = img.src;
    lightbox.classList.add('active');
  });
});

lightbox.addEventListener('click', () => lightbox.classList.remove('active'));

// Room card animation
const roomCards = document.querySelectorAll('.room-card');
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.2 });

roomCards.forEach(card => observer.observe(card));

// Shimmer parallax movement
const shimmer = document.querySelector('.shimmer-bg');
document.addEventListener('mousemove', e => {
  const x = (e.clientX / window.innerWidth - 0.5) * 30;
  const y = (e.clientY / window.innerHeight - 0.5) * 30;
  shimmer.style.transform = `translate(calc(-50% + ${x}px), calc(-50% + ${y}px)) rotate(45deg)`;
});
