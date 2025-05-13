FROM node:slim

# Update system packages and clean up
RUN apt-get update && apt-get upgrade -y && apt-get clean && rm -rf /var/lib/apt/lists/*

# Tạo thư mục làm việc
WORKDIR /app

# Copy package.json và cài đặt dependencies
COPY package.json yarn.lock ./

RUN yarn install

# Copy mã nguồn
COPY . .

# Expose port cho Vite dev server
EXPOSE 5173

# Chạy development server
CMD ["yarn", "dev", "--host"]