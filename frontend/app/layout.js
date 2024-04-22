import { Inter } from "next/font/google";
import { Providers } from "./providers";

const inter = Inter({ subsets: ["latin"] });

export const metadata = {
  title: "Create Next App",
  description: "Generated by create next app",
};

export default function RootLayout({ children }) {
    return (
        <html lang="ru">
            <body className={inter.className}>
                <Providers>{children}</Providers>
            </body>
        </html>
    );
}
