@layout('templates.layout')
<section class="w-[87%] h-fit m-auto mt-[100px] grid grid-cols-2">
  <div class="w-full flex flex-col gap-[48px]">
    <h2 class="text-[84px] font-semibold text-[#010205]">
      Crafting Digital Excellence, One Project at a Time
    </h2>
    <p class="text-[16px] w-[77%] font-medium text-[#878C91] text-justify">
      Welcome to NovaCraft Studio, where creativity meets technology. We're a dedicated team of 12 digital experts
      passionate about transforming your ideas into exceptional digital experiences.
    </p>
    <div class="flex gap-[56px] items-center">
      <button class="w-[233px] text-[16px] h-[56px] bg-[#0A66C2] transition hover:bg-[#2367ab] text-white rounded-[70px] font-bold">
        Get Started<i class="fa-solid fa-arrow-right ml-8 text-white"></i>
      </button>
      <a href="" class="text-[#010205] text-[18px] font-semibold underline">View Our Work</a>
    </div>
  </div>
  <div class="w-full">
    <img src="@asset('images/banner.jpg')" alt="Banner" class="w-full h-full object-cover">
  </div>
</section>

<section class="w-[87%] h-[500px] m-auto mt-[100px] grid grid-cols-2">
  <div>
    <img src="@asset('images/scndbanner.jpg')" class="w-[93%] h-auto object-cover" alt="second banner">
  </div>
  <div class="w-full py-[40px] px-[40px] flex flex-col gap-6">
    <h2 class="text-[48px] font-semibold text-[#010205]">What We Do?</h2>
    <p class="text-[16px] font-medium text-[#878C91] text-justify">At NovaCraft Studio, we specialize in creating
      digital solutions that make an impact. Whether you're launching a new brand, building a web application, or
      reimagining your digital presence, our team has the expertise to deliver results that exceed expectations.
    </p>
    <h2 class="text-[48px] font-semibold text-[#010205] mt-[30px]">Why Choose NovaCraft?</h2>
    <p class="text-[16px] font-medium text-[#878C91] text-justify">- Personal Attention: With a close-knit team of 12,
      every project receives the focus it deserves</p>
    <p class="text-[16px] font-medium text-[#878C91] text-justify">- Collaborative Process: We work alongside you,
      ensuring your vision guides every decision</p>
    <p class="text-[16px] font-medium text-[#878C91] text-justify">- Quality Craftsmanship: We don't just deliver
      projects—we craft digital experiences that last</p>
    <p class="text-[16px] font-medium text-[#878C91] text-justify">- Proven Track Record: Our clients trust us with
      their most important digital initiatives</p>
  </div>
</section>
@endlayout