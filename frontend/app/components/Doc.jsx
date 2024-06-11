import {Box, Stack} from "@chakra-ui/react";
import {API} from "@/app/constants";
import Image from "next/image";

export default function Doc({ href, title }) {
    return (
        <Box display="flex" gap="20px" alignItems="center">

            <a href={`${API}/${href}`}>
                <Image
                    src="/word.svg"
                    width={50}
                    height={50}
                    alt="doc pic"
                />
            </a>
            <span>{title}</span>
        </Box>

    )
}